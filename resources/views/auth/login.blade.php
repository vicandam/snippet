@extends('layouts.app')

@push('styles')
    <style>
        button.v-app-bar__nav-icon{
            display: none;
        }
    </style>
@endpush

@section('content')

    <v-container
        class="fill-height"
        fluid
    >
        <v-row
            align="center"
            justify="center"
        >
            <v-col
                cols="12"
                sm="8"
                md="4"
            >
                <v-form method="POST" action="{{ route('login') }}">
                    @csrf
                    <v-card class="elevation-12">
                        <v-toolbar
                            color="#765d55"
                            dark
                            flat
                        >
                            <v-toolbar-title>{{ __('Login') }}</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                                <v-text-field
                                    label="Email"
                                    name="email" value="{{ old('email') }}"
                                    autocomplete="email"
                                    autofocus
                                    prepend-icon="person"
                                    type="email"
                                    required
                                    color="#E64A19"
                                    @error('email')
                                    error-messages = "{{ $message }}"
                                    @enderror
                                ></v-text-field>

                                <v-text-field
                                    color="#E64A19"
                                    id="password"
                                    label="Password"
                                    name="password"
                                    required
                                    @error('password')
                                    error-messages = "{{ $message }}"
                                    @enderror
                                    autocomplete="current-password"
                                    prepend-icon="lock"
                                    type="password"
                                ></v-text-field>

                            <v-checkbox
                                type="checkbox"
                                name="remember"
                                id="remember"
                                value ="{{ old('remember') ? 'checked' : '' }}"
                                label="{{ __('Remember Me') }}"
                                color="#E64A19"
                                hide-details
                            ></v-checkbox>

                            @if (Route::has('password.request'))
                                <div class="text-right">
                                    <a class="v-btn v-btn--flat v-btn--text v-size--default" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif

                        </v-card-text>
                        <v-card-actions>
                            <div class="flex-grow-1"></div>
                            <v-btn type="submit" tile outlined dark color="#E64A19">
                                <v-icon left>fingerprint</v-icon> Login
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-col>
        </v-row>
    </v-container>
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#app',
            vuetify: new Vuetify(),
            data: () => ({
                drawer: false,
                items: [],
            }),
        })
    </script>
@endpush
