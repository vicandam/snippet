<template>
    <div class="text-center">
        <v-dialog
            v-model="userEditDialog"
            width="500"
        >

            <v-card>
                <v-card-title
                    class="headline grey lighten-2"
                    primary-title
                >
                    Update User
                </v-card-title>

                <v-spacer></v-spacer>
                <hr>
                <v-card-text>
                    <v-text-field
                        label="Name"
                        v-model="account.name"
                        v-validate       = "'required'"
                        data-vv-name     = "name"
                        :error-messages  = "errors.collect('name')"
                        color="#E64A19"
                        autocomplete="name"
                        autofocus
                        prepend-icon="person"
                        type="text"
                        required
                    ></v-text-field>

                    <v-text-field
                        color="#E64A19"
                        label="{{ __('E-Mail Address') }}"
                        autocomplete="email"
                        prepend-icon="email"
                        type="email"
                        required
                        v-model="account.email"
                        v-validate       = "'required'"
                        data-vv-name     = "email"
                        :error-messages  = "errors.collect('email')"
                    ></v-text-field>

                    <v-sheet class="pa-5">
                        <v-switch v-model="switch1" inset :label="`Update password`"></v-switch>
                    </v-sheet>

                    <div v-if="switch1">
                        <v-text-field
                            color="#E64A19"
                            id="password"
                            label="{{ __('Password') }}"
                            v-model="account.password"
                            required
                            prepend-icon="lock"
                            type="password"
                        ></v-text-field>

                        <v-text-field
                            color="#E64A19"
                            label="{{ __('Confirm Password') }}"
                            v-model="account.password_confirmation"
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
                        color="primary"
                        text
                        @click="close"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        color="primary"
                        text
                        @click="save"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
