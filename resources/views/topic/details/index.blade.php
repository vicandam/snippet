@extends('layouts.app')

@section('content')
    <template>
        <v-container fluid class="mt-12 pt-12 grey lighten-5">
            <v-row no-gutters>
                <v-col
                    cols="12"
                >
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >
                        <v-row no-gutters>
                            <v-col
                                cols="12"
                                sm="6"
                                md="6"
                            >

                                <v-row no-gutters>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="6"
                                    >
                                        <div class="pa-4">
                                            <div class="text-left">
                                                <div class="title">Details</div>
                                            </div>
                                        </div>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="6"
                                    >
                                        {{-- blank --}}
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="6"
                            >
                                <div
                                    class="pa-2 text-right">
                                    @include('topic.post.modal.create')
                                </div>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <v-row no-gutters>
                <v-col
                    cols="12"
                >
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >

                        <template>
                            <v-card
                                class="mx-auto"
                                color="#EFEBE9"
                                light
                                tile
                                flat
                            >
                                <v-card-title>
                                    <span class="title"><span class="headline font-weight-bold">Solution:</span><span
                                            v-text="title"></span></span>
                                </v-card-title>

                                <v-card-text class="mt-5 font-weight-normal">
                                    <pre class="line-numbers" v-html="description" data-start="-5"
                                         style="white-space:pre-wrap;"></pre>
                                </v-card-text>

                                <v-card-actions>
                                    <v-list-item class="grow" three-line>
                                        <v-list-item-avatar color="grey darken-3 mt-5">
                                            <v-img
                                                class="elevation-6"
                                                src="/img/avatars.png"
                                            ></v-img>
                                        </v-list-item-avatar>

                                        <v-list-item-content>
                                            <v-list-item-subtitle> Created @{{ createdAt }} by @{{ author }}</v-list-item-subtitle>
                                        </v-list-item-content>

                                        <v-row
                                            align="center"
                                            justify="end"
                                        >
                                            <v-btn text icon color="#F44336" @click="onLike(topicId)">
                                                <v-icon class="mr-1">mdi-heart</v-icon>
                                            </v-btn>
                                            <span class="subheading mr-2" v-text="likes"></span>
                                            <span class="mr-1">·</span>
                                            <v-icon class="mr-1">remove_red_eye</v-icon>
                                            <span class="subheading mr-2" v-text="views"></span>
                                            <span class="mr-1">·</span>
                                            <v-btn text icon color="indigo">
                                                <v-icon class="mr-1">mdi-share-variant</v-icon>
                                            </v-btn>
                                            <span class="subheading mr-2">45</span>

                                            @if(auth()->id() == $topic->user_id)
                                                <div class="ml-8">
                                                    <v-btn fab dark x-small color="primary" @click="edit">
                                                        <v-icon dark>edit</v-icon>
                                                    </v-btn>

                                                    <v-btn class="mx-1" fab dark x-small color="error"
                                                           @click="delete_dialog = true">
                                                        <v-icon dark>delete_forever</v-icon>
                                                    </v-btn>
                                                </div>
                                            @endif
                                        </v-row>
                                    </v-list-item>
                                </v-card-actions>
                            </v-card>
                        </template>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </template>

    @include('topic.details.modal.edit')
    @include('topic.details.modal.delete')
@endsection

@push('scripts')

    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                drawer: true,
                edit_dialog: false,
                categoryId: 1,
                selectedCategoryId: @json($topic->category_id),
                categories: [],
                title: @json($topic->title),
                description: @json($topic->description),
                topicId: @json($topic->id),
                createdAt: @json($topic->created_at),
                author: @json($topic->user->name),
                likes: @json($topic->likes),
                views: @json($topic->views),

                postDialog: false,
                page: 1,
                items: [],
                loadCategories: [],
                model: 1,

                topicDetails: {
                    categoryId: 1,
                    title: '',
                    description: ''
                },

                isLoading: false,
                delete_dialog: false,

                categoryResponse: {
                    timer: null,
                    categoryCount: 0,
                    currentPage: 0,
                    lastPages: 0,
                    previousPageUrl: 0,
                    nextPageUrl: 0,

                    filter: {
                        keyword: '',
                        paginate: 8,
                        searchBy: 'filter',
                    },
                }
            }),

            created() {
                this.loadCategories = this.categories;
                this.getAllCategories();
            },

            watch: {

            },

            methods: {
                getAllCategories:function(){
                    let _this = this;

                    axios.get('/api/all/category/')
                    .then(function (response) {
                        _this.categoryId     = _this.selectedCategoryId;
                        _this.categories     = response.data.data.categories;
                        _this.loadCategories = response.data.data.categories;
                    });
                },

                edit:function() {
                    let _this = this;
                    _this.edit_dialog = true;

                    _this.$nextTick(() => {

                        console.log('_this.categoryId', this.selectedCategoryId);

                        setTimeout(function () {

                            var config = {
                                extraPlugins: 'codesnippet',
                                codeSnippet_theme: 'dark',
                                height: 356
                            };

                            CKEDITOR.replace('editor2', config);

                        }.bind(this), 100);

                    });
                },

                deleteProceed:function() {
                    axios.delete('/api/topic/' + this.topicId).then(function (response) {
                        window.history.back();
                    })
                },

                updatePost: function (status) {
                    let _this = this;

                    this.description = CKEDITOR.instances['editor2'].getData();
                    let attributes = {
                        'category_id':  this.categoryId,
                        'title': this.title,
                        'description': this.description,
                        'status': status
                    };

                    axios.patch('/api/topic/' + this.topicId, attributes).then(function (response) {

                        location.reload(true);
                        _this.description = response.data.data.topic.description;
                        _this.edit_dialog = false;
                    })
                },

                postTopicModal: function () {
                    this.postDialog = true;

                    this.$nextTick(() => {

                        setTimeout(function () {

                            var config = {
                                extraPlugins: 'codesnippet',
                                codeSnippet_theme: 'dark',
                                height: 356
                            };

                            CKEDITOR.replace('editor1', config);

                        }.bind(this), 100);

                    });
                },

                savePost: function (status) {
                    let _this = this;

                    this.topicDetails.description = CKEDITOR.instances['editor1'].getData();

                    let attributes = {
                        'category_id': this.topicDetails.categoryId,
                        'title': this.topicDetails.title,
                        'description': this.topicDetails.description,
                        'status': status
                    };

                    axios.post('/api/topic', attributes).then(function (response) {
                        window.open('/', '_self');

                        _this.postDialog = false;
                    })
                },

                onLike:function(id) {
                    axios.post('/api/like/' + id).then((response) => {
                        this.likes = response.data.isLikeSuccessfull;
                    })
                }
            }
        })
    </script>
@endpush
