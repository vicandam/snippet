<template>
    <v-layout justify-center>
        <v-dialog
            v-model="delete_dialog"
            max-width="290"
        >
            <v-card>
                <v-card-title class="headline">Confirm</v-card-title>

                <v-card-text>
                    Are you sure you want to delete this topic?
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="delete_dialog = false"
                    >
                        Cancel
                    </v-btn>

                    <v-btn
                        color="green darken-1"
                        text
                        @click="deleteProceed"
                    >
                        Ok
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>
