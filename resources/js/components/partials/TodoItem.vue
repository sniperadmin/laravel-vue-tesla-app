<template>
    <v-list class="pa-0">
        <template v-for="todo in todos">
            <v-divider :key="`${todo.id}-divider`"></v-divider>
            <v-list-item class="todo-item">
                <v-list-item-action>
                    <v-checkbox v-model="todo.completed" @change="toggleTodo(todo)" :false-value="0" :true-value="1"
                        color="primary" v-if="!editing"></v-checkbox>
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
</template>

<script>
    export default {
        name: 'TodoItem',
        props: ['todos', 'editing'],
        methods: {
            toggleTodo(todo) {
                this.$emit('toggle-todo', todo)
            },
            removeTodo(todo) {
                this.$emit('remove-todo', todo)
            }
        }
    }

</script>

<style>

</style>
