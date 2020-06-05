@php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $topicId = (!empty($topic->id)) ? $topic->id : '';
@endphp
<template>
    <v-row justify="end">
        <v-dialog v-model="postDialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <template v-slot:activator="{ on }">

                @if(url()->current() == $actual_link.'/topic/'. $topicId)
                    <v-btn class="ma-1" tile outlined dark color="#E64A19" href="/">
                        <v-icon left>home</v-icon>
                        Home
                    </v-btn>
                    @guest
                        <v-btn class="ma-1" tile outlined dark color="#E64A19" href="{{ route('login') }}">
                            <v-icon left>mdi-pencil</v-icon>
                            Post answer
                        </v-btn>
                    @endguest

                    @auth
                        <v-btn class="ma-1" tile outlined dark @click="postTopicModal" color="#E64A19">
                            <v-icon left>mdi-pencil</v-icon>
                            Post answer
                        </v-btn>

                        <v-btn class="ma-1" tile outlined dark color="#E64A19" href="{{ url('topic-my-posts') }}">
                            <v-icon left>collections_bookmark</v-icon>
                            My post
                        </v-btn>
                    @endauth
                @else
                    @guest
                        <v-btn class="ma-1" tile outlined dark color="#E64A19" href="{{ route('login') }}">
                            <v-icon left>mdi-pencil</v-icon>
                            Post answer
                        </v-btn>
                    @endguest

                    @auth
                        <v-btn class="ma-1" tile outlined dark @click="postTopicModal" color="#E64A19">
                            <v-icon left>mdi-pencil</v-icon>
                            Post answer
                        </v-btn>
                    @endauth
                @endif

            </template>
            <v-card>
                <v-toolbar dark color="#765d55">
                    <v-btn icon dark @click="postDialog = false">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Post answers</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <v-container>
                        <v-card
                            class="mx-auto"
                            color="#EFEBE9"
                            light
                            tile
                            flat
                        >
                            <v-form method="POST" action="">
                                <v-card-text>
                                    <div>
                                        <v-autocomplete
                                            label="Categories"
                                            autocomplete="off"
                                            :items="loadCategories"
                                            v-model="topicDetails.categoryId"
                                            item-value="id"
                                            item-text="category_name"
                                            autocomplete = "off"
                                        ></v-autocomplete>

                                        <v-text-field
                                            label="Title"
                                            required
                                            v-model="topicDetails.title"
                                            autocomplete = "off"
                                        ></v-text-field>

                                        <div class="text-center">
                                            <textarea id="editor1" v-model="topicDetails.description"
                                                      data-sample-preservewhitespace></textarea>
                                        </div>
                                    </div>
                                </v-card-text>

                                <v-card-actions>
                                    <v-list-item class="grow" three-line>
                                        <v-row
                                            align="center"
                                            justify="start"
                                        >
                                            <v-btn class="ma-2" tile outlined color="primary" @click="savePost(1)">
                                                <v-icon left>save</v-icon>
                                                Public
                                            </v-btn>

                                            <v-btn class="ma-2" tile outlined color="#E64A19" @click="savePost(0)">
                                                <v-icon left>save</v-icon>
                                                Private
                                            </v-btn>
                                        </v-row>

                                        <v-row
                                            align="center"
                                            justify="end"
                                        >
                                            <v-btn class="ma-2" tile outlined color="#F44336" @click="postDialog=false">
                                                <v-icon left>close</v-icon>
                                                Cancel
                                            </v-btn>
                                        </v-row>
                                    </v-list-item>
                                </v-card-actions>

                            </v-form>
                        </v-card>
                    </v-container>
                </v-card-text>
            </v-card>
        </v-dialog>
    </v-row>
</template>
