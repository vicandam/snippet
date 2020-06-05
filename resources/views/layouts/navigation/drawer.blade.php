<v-navigation-drawer
    v-model="drawer"
    app
    clipped
    color="grey lighten-4"
>
    <v-list
        dense
        class="grey lighten-4"
    >
        <template>
            <v-divider
                dark
                class="my-4 mt-12"
            ></v-divider>

            <v-list-item
                :href="'{{ url('/') }}'"
            >
                <v-list-item-action>
                    <v-icon>home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Home
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-item
                :href="'{{ url('/topic-my-posts') }}'"
            >
                <v-list-item-action>
                    <v-icon left>collections_bookmark</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        My Post
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-list-item href="{{ route('developer.index') }}">
                <v-list-item-action>
                    <v-icon>developer_board</v-icon>
                </v-list-item-action>

                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Developers
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            @if(isset(auth()->user()->super_user) && auth()->user()->super_user)
                    <v-list-item href="{{ route('user.index') }}">
                        <v-list-item-action>
                            <v-icon>supervised_user_circle</v-icon>
                        </v-list-item-action>

                        <v-list-item-content>
                            <v-list-item-title class="grey--text">
                                Users
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item href="{{ route('category.index') }}">
                        <v-list-item-action>
                            <v-icon>category</v-icon>
                        </v-list-item-action>

                        <v-list-item-content>
                            <v-list-item-title class="grey--text">
                                Categories
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
            @endif

            <v-list-item href="{{ route('blog.index') }}">
                <v-list-item-action>
                    <v-icon>library_books</v-icon>
                </v-list-item-action>

                <v-list-item-content>
                    <v-list-item-title class="grey--text">
                        Blog's
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
    </v-list>
</v-navigation-drawer>
