<template>
    <v-container>
        <h3 class="mb-4">Todo App</h3>
        <v-layout row wrap>
            <v-flex text-center>
                <add-todo :todos="todos" @toggle-all="toggleAll" @add-todo="addTodo" />

                <!-- list -->
                <v-card class="mt-3" v-show="todos.length">
                    <v-progress-linear class="my-0" v-model="progressPercentage" />
                    <v-card-actions class="px-3" v-show="todos.length">
                        <span class="primary--text">
                            {{ remaining }} {{ remaining | pluralize('item') }} left
                        </span>
                        <v-spacer></v-spacer>
                        <v-btn-toggle class="elevation-0" mandatory v-model="visibility" v-show="todos.length">
                            <v-btn
                                v-for="(val, key) in filters"
                                :key="key"
                                :to="key"
                                :value="key"
                                class="mx-0"
                                color="primary"
                                text
                                small
                            >
                                {{ key | capitalize }}
                            </v-btn>
                        </v-btn-toggle>
                    </v-card-actions>

                    <!-- TodoItem -->
                    <v-list class="pa-0">
                        <template v-for="todo in filteredTodos">
                            <v-divider :key="`${todo.id}-divider`"></v-divider>
                            <v-list-item class="todo-item">
                                <v-list-item-action>
                                    <v-checkbox
                                        v-model="todo.completed"
                                        @change="toggleTodo(todo)"
                                        :false-value="0"
                                        :true-value="1"
                                        color="primary"
                                        v-if="!editing"
                                    ></v-checkbox>
                                    <v-icon color="primary" v-else>mdi-edit</v-icon>
                                </v-list-item-action>
                                <template v-if="!editing">
                                    <v-list-item-content>
                                        {{ todo.todo }}
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-btn color="red lighten-3" text icon @click="removeTodo(todo)">
                                            <v-icon>mdi-cancel</v-icon>
                                        </v-btn>
                                    </v-list-item-action>
                                </template>
                                <!-- <v-text-field :value="todo.todo" @blur="doneEdit" @keyup.enter="doneEdit"
                                    @keyup.esc="cancelEdit" clearable color="primary" flat hide-details maxlength="1023"
                                    ref="input" solo v-else v-focus="editing"></v-text-field> -->
                            </v-list-item>
                        </template>
                    </v-list>
                </v-card>

                <v-btn
                    @click="clearCompleted"
                    block
                    class="mt-3"
                    color="primary"
                    depressed
                    rounded
                    v-show="todos.length > remaining"
                >
                    Clear completed
                </v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import {
        AddTodo
    } from './partials'

    const filters = {
        all: todos => todos,
        active: todos => todos.filter(todo => todo.completed === 0),
        completed: todos => todos.filter(todo => todo.completed === 1)
    }

    export default {
        name: 'Todo',
        props: ['filter'],
        components: {
            AddTodo
        },
        data() {
            return {
                filters: filters,
                visibility: this.filter,
                todos: [],
                editing: false
            }
        },
        computed: {
            filteredTodos() {
                return filters[this.visibility](this.todos)
            },
            progressPercentage() {
                const len = this.todos.length
                return ((len - this.remaining) * 100) / len
            },
            remaining() {
                if (this.todos.length)
                    return this.todos.filter(todo => todo.completed === 0).length
            },
        },
        methods: {
            getTodos() {
                this.axios.get('api/todos')
                .then(res => {
                    console.log(res);
                    this.todos = res.data.todos;
                }).catch()
            },
            toggleTodo(todo) {
                todo.completed === 0 ? todo.completed = 1 : todo.completed = 0;

                this.axios.put('api/todos/' + todo.id, todo).then((res) => {
                    this.getTodos()
                })
            },
            addTodo(todo) {
                const text = todo.trim()
                if (text) {
                    // this.$store.dispatch('addTodo', text)
                    console.log("Added todo", text)
                    this.axios.post('api/todos', { todo: text })
                        .then(() => {
                            this.getTodos()
                        }).catch()
                }
            },
            removeTodo(todo) {
                console.log(todo.id);
                this.axios.delete('api/todos/' + todo.id)
                    .then((res) => {
                        this.getTodos()
                    }).catch()
            },
            clearCompleted() {
                this.todos.filter(todo => todo.completed === 1)
                    .forEach(todo => {
                        // this.todos.splice(this.todos.indexOf(todo), 1)
                        this.axios.delete('api/todos/' + todo.id)
                            .then(() => {
                                console.log('Deleted!')
                            })
                            .catch(e => console.log('Err deleting'))
                        })

                this.getTodos()
            },
            toggleAll(value) {
                this.todos.forEach(todo => {
                    todo.completed = value

                    this.axios.put('api/todos/' + todo.id, todo)
                        .then(() => console.log('Toggled all!'))
                        .catch((e) => console.log('Err toggling all!'))
                })
                this.getTodos()
            }
        },
        filters: {
            pluralize: (n, w) => n === 1 ? w : (w + 's'),
            capitalize: s => s.charAt(0).toUpperCase() + s.slice(1)
        },

        mounted() {
            this.getTodos()
        }

    }

</script>

<style>

</style>
