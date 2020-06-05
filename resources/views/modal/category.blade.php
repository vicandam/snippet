<v-dialog v-model    = "categoryDialog"
          max-width  = "500px"
>
    <v-card>
        <v-card-title>
            <span class  = "headline" v-text="formTitle"></span>
        </v-card-title>

        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols = "12"
                           sm   = "12"
                           md   = "12">

                        <v-text-field
                            required
                            v-model          = "category.name"
                            label            = "Category Name"
                            prepend-icon     = "edit"
                            v-validate       = "'required'"
                            data-vv-name     = "category"
                            :error-messages  = "errors.collect('category')"
                            color            = "#979895"
                            @keyup.enter     = "save"
                        ></v-text-field>

{{--                        <template>--}}
{{--                            <v-file-input--}}
{{--                                label="File input"--}}
{{--                                accept="image/png, image/jpeg, image/bmp"--}}
{{--                                v-model="category.image"--}}{{--imageData"--}}
{{--                                filled--}}
{{--                                prepend-icon="mdi-camera"--}}
{{--                            ></v-file-input>--}}
{{--                        </template>--}}
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>

        <v-card-actions>

            <div class  = "flex-grow-1"></div>
            <v-flex xs12
                    sm2
                    mr-2
            >
                <v-hover v-slot:default  = "{ hover }">
                    <v-btn
                        color       = "#575757"
                        @click      = "close"
                        :class      = "{ 'hover-btn' : hover }"
                        class       = "white--text"
                        :elevation  = "0"
                        tile
                        block
                    >Cancel
                    </v-btn>
                </v-hover>
            </v-flex>

            <v-flex xs12
                    sm2
            >
                <v-hover v-slot:default="{ hover }">
                    <v-btn
                        :disabled   = "errors.any()"
                        @click      = "save"
                        class       = "white--text"
                        :elevation  = "0"
                        color       = "#765d55"
                        tile
                        block
                    >
                        Save
                    </v-btn>
                </v-hover>
            </v-flex>
        </v-card-actions>
    </v-card>
</v-dialog>
