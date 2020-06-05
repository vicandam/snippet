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
                                                <div class="title">Settings</div>
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
                                    {{--                                    @include('topic.post.modal.create')--}}
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
                                class="overflow-hidden"
                                color="#765d55 lighten-1"
                                dark
                            >
                                <v-toolbar
                                    flat
                                    color="#765d55"
                                >
                                    <v-icon>settings_applications</v-icon>
                                    <v-toolbar-title class="font-weight-light ml-1"> User Profile</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        color="#765d55 darken-3"
                                        fab
                                        small
                                        @click="isEditing = !isEditing"
                                    >
                                        <v-icon v-if="isEditing">mdi-close</v-icon>
                                        <v-icon v-else>mdi-pencil</v-icon>
                                    </v-btn>
                                </v-toolbar>
                                <v-card-text>
                                    <v-text-field
                                        label="Name"
                                        color="#E64A19"
                                        :disabled="!isEditing"
{{--                                        name="name" value="{{ old('name') }}"--}}
                                        v-model="account.name"
                                        autocomplete="name"
                                        autofocus
                                        prepend-icon="person"
                                        type="text"
                                        required
                                        @error('name')
                                        error-messages="{{ $message }}"
                                        @enderror
                                    ></v-text-field>


                                    <v-text-field
                                        color="#E64A19"
                                        label="{{ __('E-Mail Address') }}"
{{--                                        name="email" value="{{ old('email') }}"--}}
                                        :disabled="!isEditing"
                                        v-model="account.email"
                                        autocomplete="email"
                                        prepend-icon="email"
                                        type="email"
                                        required
                                        @error('email')
                                        error-messages="{{ $message }}"
                                        @enderror
                                    ></v-text-field>

                                    <v-sheet class="pa-5">
                                        <v-switch v-model="switch1" :disabled="!isEditing" inset :label="`Change password`"></v-switch>
                                    </v-sheet>

                                    <div v-if="switch1">
                                        <v-text-field
                                            color="#E64A19"
                                            id="password"
                                            label="{{ __('Password') }}"
{{--                                            name="password"--}}
                                            required
                                            v-model="account.password"
                                            @error('password')
                                            error-messages="{{ $message }}"
                                            @enderror
                                            autocomplete="new-password"
                                            prepend-icon="lock"
                                            type="password"
                                        ></v-text-field>

                                        <v-text-field
                                            color="#E64A19"
                                            id="password-confirm"
                                            label="{{ __('Confirm Password') }}"
                                            name="password_confirmation"
                                            required
                                            autocomplete="new-password"
                                            prepend-icon="lock"
                                            type="password"
                                        ></v-text-field>
                                    </div>
                                </v-card-text>
                                <v-divider></v-divider>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        :disabled="!isEditing"
                                        color="success"
                                        @click="save"
                                    >
                                        Save
                                    </v-btn>
                                </v-card-actions>
                                <v-snackbar
                                    v-model="hasSaved"
                                    :timeout="2000"
                                    absolute
                                    color="success"
                                    bottom
                                    left
                                >
                                    Your profile has been updated
                                </v-snackbar>
                            </v-card>
                        </template>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </template>

    {{--    @include('topic.details.modal.edit')--}}
@endsection

@push('scripts')

    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                drawer: true,
                edit_dialog: false,
                switch1: false,
                model: 1,

                isLoading: false,
                delete_dialog: false,

                account: {
                    name: @json($user->name),
                    email: @json($user->email),
                    password: '',
                },

                hasSaved: false,
                isEditing: null,
                model: null,

                userId: @json($user->id)
            }),


            mounted() {

            },

            methods: {
                save() {
                    let _this = this;
                    let attributes = {
                        name: this.account.name,
                        email: this.account.email,
                        password: this.account.password
                    };

                    axios.patch('/api/user/' + this.userId, attributes).then(function (response) {
                        _this.isEditing = !this.isEditing;
                        _this.hasSaved = true

                        _this.clearFields();
                    })
                },

                edit: function () {
                    let _this = this;
                    this.edit_dialog = true;
                },
                clearFields: function () {
                    this.password =  '';
                    this.switch1 = false;
                }
            }
        })
    </script>
@endpush
