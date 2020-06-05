<template v-if="isLoading">
    <div class="pa-3">
        <v-card
            class="mx-auto"
            color="#EFEBE9"
            tile
            flat
        >
            <v-card-text class="title text-center">
                <div class="text-center">
                    <v-progress-circular
                        indeterminate
                        color="amber"
                    ></v-progress-circular>
                </div>
            </v-card-text>
        </v-card>
</template>
