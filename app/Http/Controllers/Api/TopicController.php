<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;
use App\Like;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request;

        $categoryId = $request['categoryId'];

        $topics = new Topic();

        $topics = $topics->where('is_public', 1);

        if ($categoryId > 0) {
            $topics = $topics->where('category_id', $categoryId);
        }

        if (!empty($input['keyword'])) {
            $topics = $topics->searchFilter($input['keyword']);
        }

        $topics = $topics->with(['category', 'user']);

        $topics = $topics->orderBy('id', 'desc');

        $topics = $topics->paginate($input['paginate']);

        $result = [
            'message' => 'Topics successfully retrieve',
            'data' => [
                'topics' => $topics,
                'topic_count' => $topics->count()
            ]
        ];

        return response()->json( $result, 200, [], JSON_PRETTY_PRINT);
    }

    public function showUserPost(Request $request)
    {
        $input = $request;

        $categoryId = $request['categoryId'];

        $topics = new Topic();

        $topics = $topics->where('user_id', auth()->id());

        if ($categoryId > 0) {
            $topics = $topics->where('category_id', $categoryId);
        }

        if (!empty($input['keyword'])) {
            $topics = $topics->searchFilter($input['keyword']);
        }

        $topics = $topics->with(['category', 'user']);

        $topics = $topics->orderBy('id', 'desc');

        $topics = $topics->paginate($input['paginate']);

        $categories = Category::all();

        $result = [
            'message' => 'Topics successfully retrieve',
            'data' => [
                'topics' => $topics,
                'topic_count' => $topics->count(),
                'categories' => $categories
            ]
        ];

        return response()->json( $result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicStoreRequest $request)
    {
        $input = $request;

        $topic = new Topic();

        $topic->user_id     = auth()->id();
        $topic->category_id = $input['category_id'];
        $topic->title       = $input['title'];
        $topic->description = $input['description'];
        $topic->is_public   = $input['status'];

        $topic->save();

        $result = [
            'message' => 'Topic successfully added',
            'data'    => [
                'topic' => $topic
            ]
        ];

        return response()->json( $result, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $input = $request;

        $topic->category_id = $input['category_id'];
        $topic->title       = $input['title'];
        $topic->description = $input['description'];
        $topic->is_public   = $input['status'];

        $topic->save();

        $result = [
            'message' => 'Topic successfully updated',
            'data'    => [
                'topic' => $topic
            ]
        ];

        return response()->json( $result, 200, [], JSON_PRETTY_PRINT);
    }

    public function like($id)
    {
        if (Auth::user()) {
            $input['user_id'] = auth()->id();
            $input['topic_id'] = $id;

            $like = Like::where('topic_id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if ($like) {
                Topic::find($id)->decrement('likes');

                Like::find($like->id)->delete();
                $message = 'unliked';
            } else {
                Topic::find($id)->increment('likes');

                Like::create($input);
                $message = 'liked';
            }

            $topic = Topic::find($id);

            return response()->json(['isLikeSuccessfull' => $topic->likes, 'message' => $message]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return 'true';
    }
}
