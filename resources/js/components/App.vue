<template>
    <v-app dark>
        <v-app-bar color="light-blue" app dark>
            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>

            <v-toolbar-title>Title</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" app absolute temporary>
            <v-list nav dense>
                <v-list-item-group v-model="group" active-class="light-blue--text text--accent-4">
                    <v-list-item v-for="(item, i) in filteredLinks" :key="i" :to="item.to">
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
                    { icon: 'mdi-home', name: 'Home', to: '/', protected: false },
                    { icon: 'mdi-account', name: 'Login', to: '/login', protected: false, hide: true },
                    { icon: 'mdi-account', name: 'Signup', to: '/signup', protected: false, hide: true },
                    { icon: 'mdi-account', name: 'Account', to: '/profile', protected: true },
                    { icon: 'mdi-account', name: 'My Todos', to: '/todos/all', protected: true },
                ]
            }
        },
        computed: {
            filteredLinks() {
                const { $auth, links } = this
                return links.filter(
                    l => $auth.check() || !l.protected
                )
            }
        }
    }
</script>
