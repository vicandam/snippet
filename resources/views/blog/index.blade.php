@extends('layouts.app')
@section('content')
    <template>
        <v-container fluid class="mt-12 pt-12 grey lighten-5">
            <v-row>
                <v-col cols="12">
                    <v-card
                        class="pa-2 text-center"
                        outlined
                        tile
                    >
                        <v-card-text class="text--primary">
                            <div>CONTACT US IF YOU NEED YOUR BLOG'S TO BE FEATURED</div>
                        </v-card-text>

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
