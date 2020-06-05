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
                                md="8"
                            >

                                <v-row no-gutters>
                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="4"
                                    >
                                        <div class="pa-4">
                                            <div class="text-left">
                                                <div class="title">Top answers</div>
                                            </div>
                                        </div>
                                    </v-col>

                                    <v-col
                                        cols="12"
                                        sm="6"
                                        md="8"
                                    >
                                        <div class="pt-2 pb-2">
                                            <div class=" text-right">
                                                <v-btn class="ma-1" tile outlined dark color="#E64A19">
                                                    <v-icon left>whatshot</v-icon>
                                                    Latest
                                                </v-btn>
                                                <v-btn tile outlined dark color="#E64A19">
                                                    <v-icon left>stars</v-icon>
                                                    Top
                                                </v-btn>
                                                <v-btn class="ma-1" tile outlined dark color="#E64A19" href="/">
                                                    <v-icon left>home</v-icon>
                                                    Home
                                                </v-btn>
                                            </div>
                                        </div>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
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
                    sm="6"
                    md="8"
                >
                    <v-card
                        class="pa-2 mt-2"
                        outlined
                        tile
                    >
                        <v-card
                            class="mx-auto pa-3"
                            light
                            tile
                            flat
                        >
                            <div>
                                <v-text-field
                                    v-model         = "filter.keyword"
                                    color="blue-grey lighten-2"
                                    solo-inverted
                                    flat
                                    hide-details
                                    label="Search my post"
                                    append-icon="search"
                                    @keyup="searchTopics"
                                ></v-text-field>
                            </div>
                        </v-card>

                        <template v-if="topicCount > 0" v-for="topic in topics.data">
                            <div class="pa-3">
                                <v-card
                                    class="mx-auto"
                                    color="#EFEBE9"
                                    light
                                    tile
                                    flat
                                >
                                    <v-card-title @click="viewTopic(topic.id)" style="cursor: pointer;">
                                        <v-avatar size="50px" class="mr-2">
                                            <img
                                                :src="'/storage/avatars/' + topic.category.image"
                                                alt="John"
                                            >
                                        </v-avatar>
                                        <span class="headline">@{{ topic.category.name }}</span>
                                    </v-card-title>

                                    <v-card-text @click="viewTopic(topic.id)">
                                        <span class="title" style="text-transform: initial; cursor: pointer;">@{{ topic.title }}</span>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-list-item class="grow" three-line>
                                            <v-list-item-avatar color="grey darken-3 mt-5">
                                                <v-img
                                                    class="elevation-6"
                                                    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                                                ></v-img>
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-subtitle class="font-italic" style="text-transform: initial;">Created @{{ topic.created_at }} by <span v-if="topic.user != null" v-text="topic.user.name"></span></v-list-item-subtitle>
                                            </v-list-item-content>

                                            <v-row
                                                align="center"
                                                justify="end"
                                            >
                                                <v-btn text icon color="#F44336" @click="onLike(topic.id)">
                                                    <v-icon class="mr-1">mdi-heart</v-icon>
                                                </v-btn>
                                                <span class="subheading mr-2" v-text="topic.likes"></span>
                                                <span class="mr-1">·</span>
                                                <v-icon class="mr-1">remove_red_eye</v-icon>
                                                <span class="subheading mr-2" v-text="topic.views"></span>
                                                <span class="mr-1">·</span>
                                                <v-btn text icon color="indigo">
                                                    <v-icon class="mr-1">mdi-share-variant</v-icon>
                                                </v-btn>
                                                <span class="subheading mr-2">45</span>
                                            </v-row>
                                        </v-list-item>
                                    </v-card-actions>
                                </v-card>
                            </div>
                        </template>

                        @include('spinner.index')

                        <template v-if="topicCount == 0 && isLoading == false">
                            <div class="pa-3">
                                <v-card
                                    class="mx-auto"
                                    color="#EFEBE9"
                                    tile
                                    flat
                                >
                                    <v-card-text class="title text-center">
                                        No Results found
                                    </v-card-text>

                                </v-card>
                            </div>
                        </template>

                        <template>
                            <div class="mt-3" v-if="topicCount > 0 && nextPageUrl != null || previousPageUrl != null">
                                <div class="text-center" v-if="isLoading == false">
                                    <v-pagination
                                        v-model="currentPage"
                                        :length="lastPages"
                                        prev-icon="mdi-menu-left"
                                        next-icon="mdi-menu-right"
                                        :total-visible="5"
                                        circle
                                        @input="next"
                                    ></v-pagination>
                                </div>

                            </div>
                        </template>
                    </v-card>
                </v-col>

                <v-col
                    cols="6"
                    md="4"
                >
                    @include('topic.categories.index')

                </v-col>
            </v-row>
        </v-container>
    </template>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#app',
            data: () => ({
                drawer: true,
                page: 1,
                items: [],
                topics: [],
                bottom: false,
                categories: [],
                loadCategories: [],
                topicCount: 0,

                isLoading:             false,
                disabled:              false,
                timer:                 null,
                currentPage:           0,
                lastPages:             0,
                previousPageUrl:       0,
                nextPageUrl:           0,

                postDialog: false,
                topicDetails: {
                    categoryId: 1,
                    title: '',
                    description: ''
                },

                categoryResponse: {
                    timer:                 null,
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
                },

                filter: {
                    categoryId: 0,
                    keyword:               '',
                    paginate:              5,
                    searchBy:              'filter',
                },
            }),
            vuetify: new Vuetify(),

            mounted() {
                this.searchTopics();
                this.searchCategory();
                this.getAllCategories();
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

                searchTopics: function () {
                    var _this                           = this;
                    _this.topics.data  = [];

                    _this.filter.page                   = 1;

                    let url                             = '/api/user-post';
                    let attributes                      = _this.filter;
                    var searchParameters                = new URLSearchParams();

                    Object.keys(attributes).forEach(function (parameterName) {
                        searchParameters.append(parameterName, attributes[parameterName]);
                    });

                    url = url + '/?' + searchParameters.toString();

                    if (_this.timer) {
                        _this.isLoading  = true;
                        clearTimeout(_this.timer);
                        _this.timer      = null;
                    }

                    this.timer = setTimeout(() => {
                        axios.get(url)
                            .then(function (response) {

                                _this.topics          = response.data.data.topics;
                                _this.topicCount      = response.data.data.topic_count;
                                _this.currentPage     = response.data.data.topics.current_page;
                                _this.lastPages       = response.data.data.topics.last_page;
                                _this.previousPageUrl = response.data.data.topics.prev_page_url;
                                _this.nextPageUrl     = response.data.data.topics.next_page_url;

                                _this.isLoading = false;
                            });
                    }, 800);
                },

                next (pageNumber) {
                    var _this             = this;

                    _this.filter.page     = pageNumber;

                    let url               = '/api/user-post';
                    let attributes        = _this.filter;

                    var searchParameters  = new URLSearchParams();

                    Object.keys(attributes).forEach(function (parameterName) {
                        searchParameters.append(parameterName, attributes[parameterName]);
                    });

                    url  = url + '/?' + searchParameters.toString();

                    axios.get(url).then(function (response) {

                        _this.topicCount       = response.data.data.topic_count;
                        _this.currentPage      = response.data.data.topics.current_page;
                        _this.lastPages        = response.data.data.topics.last_page;
                        _this.previousPageUrl  = response.data.data.topics.prev_page_url;
                        _this.nextPageUrl      = response.data.data.topics.next_page_url;

                        if (response.data.data.topics.data) {

                            _this.topics.data  = [];

                            response.data.data.topics.data.filter(function (topic) {

                                _this.topics.data.push(topic);
                            });
                        }
                    });
                },

                searchCategory: function () {
                    var self = this;
                    self.categories.data = [];

                    var url = "/api/category";
                    let attributes = this.categoryResponse.filter;

                    var searchParameters = new URLSearchParams();

                    Object.keys(attributes).forEach(function (parameterName) {
                        searchParameters.append(parameterName, attributes[parameterName]);
                    });

                    url = url + '/?' + searchParameters.toString();

                    if (this.categoryResponse.timer) {
                        this.isLoading = true;
                        clearTimeout(this.categoryResponse.timer);
                        this.categoryResponse.timer = null;
                    }

                    this.categoryResponse.timer = setTimeout(() => {

                        axios.get(url)
                            .then(function (response) {

                                self.categories = response.data.data.categories;
                                self.categoryResponse.categoryCount = response.data.data.category_count;
                                self.categoryResponse.currentPage = response.data.data.categories.current_page;
                                self.categoryResponse.lastPages = response.data.data.categories.last_page;
                                self.categoryResponse.previousPageUrl = response.data.data.categories.prev_page_url;
                                self.categoryResponse.nextPageUrl = response.data.data.categories.next_page_url;

                                self.isLoading = false;
                            });
                    }, 800);
                },

                nextCategory (pageNumber) {
                    var _this             = this;

                    _this.categoryResponse.filter.page     = pageNumber;

                    let url               = '/api/category';
                    let attributes        = _this.categoryResponse.filter;

                    var searchParameters  = new URLSearchParams();

                    Object.keys(attributes).forEach(function (parameterName) {
                        searchParameters.append(parameterName, attributes[parameterName]);
                    });

                    url  = url + '/?' + searchParameters.toString();

                    axios.get(url).then(function (response) {

                        console.log(response);

                        _this.categoryResponse.categoryCount    = response.data.data.category_count;
                        _this.categoryResponse.currentPage      = response.data.data.categories.current_page;
                        _this.categoryResponse.lastPages        = response.data.data.categories.last_page;
                        _this.categoryResponse.previousPageUrl  = response.data.data.categories.prev_page_url;
                        _this.categoryResponse.nextPageUrl      = response.data.data.categories.next_page_url;

                        if (response.data.data.categories.data) {

                            _this.categories.data  = [];

                            response.data.data.categories.data.filter(function (category) {

                                _this.categories.data.push(category);
                            });
                        }
                    });
                },

                showCategory:function(categoryId){
                    this.filter.categoryId = categoryId;
                    this.searchTopics();
                },

                viewTopic: function (topicId) {
                    window.open('/topic/'+ topicId, '_self');
                },

                postTopicModal:function () {
                    this.postDialog = true;

                    this.$nextTick(() => {

                        setTimeout(function(){

                            var config = {
                                extraPlugins: 'codesnippet',
                                codeSnippet_theme: 'dark',
                                height: 356
                            };

                            CKEDITOR.replace('editor1', config);

                        }.bind(this),100);

                    });
                },

                savePost: function(status) {
                    let _this = this;

                    this.topicDetails.description = CKEDITOR.instances['editor1'].getData();

                    let attributes = {
                        'category_id': this.topicDetails.categoryId,
                        'title': this.topicDetails.title,
                        'description': this.topicDetails.description,
                        'status': status
                    };

                    axios.post('/api/topic', attributes).then(function (response) {
                        _this.searchTopics();
                        _this.postDialog = false;
                    })
                },

                onLike(id) {
                    axios.post('/api/like/' + id).then((response) => {
                        this.searchTopics();
                    })
                }
            }
        })
    </script>
@endpush
