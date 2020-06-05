@extends('layouts.app')
@section('content')
    <template>
        <v-container fluid class="mt-12 pt-12 grey lighten-5">
            <v-row>
                <v-col cols="4">
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="/img/developer/jesus.jpg"
                        >
                            <v-card-title>Jesus Erwin Suarez</v-card-title>
                        </v-img>

                        <v-card-text class="text--primary">
                            <div>Whitsunday Island, Whitsunday Islands</div>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn
                                color="orange"
                                text
                            >
                                Share
                            </v-btn>

                            <v-btn
                                href ="http://jesuserwinsuarez.com/contact"
                                target ="_blank"
                                color="orange"
                                text
                            >
                                Explore
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <v-col cols="4">
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="/img/developer/vic.jpg"
                        >
                            <v-card-title>Vic Andam</v-card-title>
                        </v-img>

                        <v-card-text class="text--primary">
                            <div class="font-italic">
                                "I can do all this through him who gives me strength."
                                <p class="text-right">- Philippians 4:13</p>
                            </div>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn
                                color="orange"
                                text
                            >
                                Share
                            </v-btn>

                            <v-btn
                                href ="http://vicandam.com/"
                                target ="_blank"
                                color="orange"
                                text
                            >
                                Explore
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <v-col cols="4">
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >
                        <v-img
                            class="white--text align-end"
                            height="200px"
                            src="/img/developer/ariel.jpg"
                        >
                            <v-card-title>Ariel Obejero</v-card-title>
                        </v-img>

                        <v-card-text class="text--primary">
                            <div>Never Quit!</div>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn
                                color="orange"
                                text
                            >
                                Share
                            </v-btn>

                            <v-btn
                                color="orange"
                                text
                            >
                                Explore
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>

            <v-row no-gutters>
                <v-col
                    md="6"
                    offset-md="3"
                >
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >
                        <v-img
                            class="white--text align-end"
                            height="400px"
                            src="/img/logo.png"
                        >
                        </v-img>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </template>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                drawer: true,
                items: [],
            }),

            mounted() {},

            methods: {}
        })
    </script>
@endpush
