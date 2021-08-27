<template>
    <v-app dark>
        <v-app-bar color="light-blue" app dark>
            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

            <v-toolbar-title>Title</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" app absolute temporary>
            <v-list nav dense>
                <v-list-item-group v-model="group" active-class="light-blue--text text--accent-4">
                    <v-list-item v-for="(item, i) in links" :key="i" :to="item.to">
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>{{ item.name }}</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                drawer: false,
                group: null,
                links: [
                    { icon: 'mdi-home', name: 'Home', to: '/' },
                    { icon: 'mdi-account', name: 'Account', to: '/profile' },
                    { icon: 'mdi-account', name: 'Login', to: '/login' },
                    { icon: 'mdi-account', name: 'Signup', to: '/signup' },
                    { icon: 'mdi-account', name: 'My Todos', to: '/todos/all' },
                ]
            }
        },
        mounted() {
            console.info(this.$auth);
        }
    }
</script>
