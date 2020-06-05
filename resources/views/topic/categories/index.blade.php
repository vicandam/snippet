<v-card
    class="pa-2"
    tile
    flat
    elevation ="0"
>
    <template>
        <v-card
            class="mx-auto"
            max-width="400"
        >

            <v-list>
                <v-subheader class="headline">Categories</v-subheader>

                <v-list-item class="mb-4">
                    <v-list-item-content>
                        <v-text-field
                            v-model ="categoryResponse.filter.keyword"
                            flat
                            hide-details
                            label="Search"
                            append-icon="search"
                            @keyup="searchCategory"
                        ></v-text-field>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item-group mandatory color="indigo">
                    <v-list-item
                        v-for="(category, i) in categories.data"
                        :key="i"
                        @click="showCategory(category.id)"
                    >
                        <v-list-item-avatar color="grey darken-3">
                            <v-img
                                class="elevation-6"
                                :src="'/storage/avatars/' + category.image"
                            ></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title v-text="category.name"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>

            <template>
                <div class="pb-6" v-if="categoryResponse.categoryCount > 0 && categoryResponse.nextPageUrl != null || categoryResponse.previousPageUrl != null">
                    <div class="text-center" v-if="isLoading == false">
                        <v-pagination
                            v-model="categoryResponse.currentPage"
                            :length="categoryResponse.lastPages"
                            prev-icon="mdi-menu-left"
                            next-icon="mdi-menu-right"
                            :total-visible="5"
                            circle
                            @input="nextCategory"
                        ></v-pagination>
                    </div>
                </div>
            </template>
        </v-card>
    </template>
</v-card>
