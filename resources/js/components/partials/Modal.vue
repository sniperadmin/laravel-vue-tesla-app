<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="text-h5">User Profile</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <!-- <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Legal first name*" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Legal middle name" hint="example of helper text only on focus">
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field label="Legal last name*" hint="example of persistent helper text"
                                    persistent-hint required></v-text-field>
                            </v-col> -->
                            <v-col cols="12">
                                <v-text-field v-model="loginForm.email" label="Email*" required></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field v-model="loginForm.password" label="Password*" type="password" required></v-text-field>
                            </v-col>
                            <!-- <v-col cols="12" sm="6">
                                <v-select :items="['0-17', '18-29', '30-54', '54+']" label="Age*" required></v-select>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-autocomplete
                                    :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                                    label="Interests" multiple></v-autocomplete>
                            </v-col> -->
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="$router.back()">
                        Close
                    </v-btn>
                    <v-btn color="blue darken-1" text @click="submitLogin">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
    export default {
        name: 'Modal',
        data() {
            return {
                dialog: false,
                loginForm: {
                    email: 'nash@me.com',
                    password: '123456'
                }
            }
        },

        methods: {
            submitLogin() {
                this.$auth
                    .login({
                        body: this.loginForm,
                        data: this.loginForm,
                        redirect: null,
                        staySignedIn: false,
                        fetchUser: true,
                    }).then(res => {
                        console.log('Successfully logged in: ', this.$auth);
                    })
            }
        },

        computed: {
            _user() {
                return this.$auth.user()
            },
            _token() {
                return this.$auth.token()
            }
        },

        watch: {
            $route: {
                immediate: true,
                handler: function (newValue, oldValue) {
                    this.dialog = newValue.meta.showModal;
                }
            }
        }
    }

</script>

<style>

</style>
