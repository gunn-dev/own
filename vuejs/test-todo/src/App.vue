<template>
  <div class="card p-5 mt-5 ">
    <div class="text-center">
      <h1>To-Do List</h1>
      <to-do-form @todo-added="addToDo"></to-do-form>
    </div>
    <h4 tabindex="-1"> {{ listSummary}}</h4>
    <ul class="py-3" aria-lablledby="list-summary">
      <li v-for="item in ToDoItems" :key="item.id">
        <to-do-item 
          :label="item.label" 
          :done="item.done" 
          :id="item.id"
          @item-deleted="deleteToDo(item.id)"
          @item-edited="editToDo(item.id, $event)"
          @checkbox-changed="updateDoneStatus(item.id)"
          >
        </to-do-item>
      </li>
    </ul>
  </div>
</template>

<script>
import ToDoForm from './components/ToDoForm.vue'
import uniqueId from 'lodash.uniqueid'
import ToDoItem from './components/ToDoItem.vue'

export default {
  name: 'App',
  components: {
    ToDoForm,
    ToDoItem,
  },
  data() {
    return {
      ToDoItems: [
        { id: uniqueId('todo-'), label: 'Learn Vue', done: false},
        { id: uniqueId('todo-'), label: 'Learn React', done: true}
      ]
    };
  },
  methods: {
    addToDo(toDoLabel) {
      this.ToDoItems.push({ id:uniqueId('todo-'), label: toDoLabel, done: false });
    },
    deleteToDo(toDoId) {
      const itemIndex = this.ToDoItems.findIndex(item => item.id === toDoId);
      this.ToDoItems.splice(itemIndex, 1);
    },
    editToDo(toDoId, newLabel) {
      const toDoToEdit = this.ToDoItems.find(item => item.id === toDoId);
      toDoToEdit.label = newLabel;
    },
    updateDoneStatus(toDoId) {
      const toDoToUpdate = this.ToDoItems.find(item => item.id === toDoId);
      toDoToUpdate.done = !(toDoToUpdate.done)
    }
  },
  computed: {
    listSummary() {
      const numberFinishedItems = this.ToDoItems.filter(item => item.done).length;
      return `${numberFinishedItems} out of ${this.ToDoItems.length} items completed.`;
    }
  }
}
</script>

<style>
.card {
  max-width: 600px;
  margin: auto;
}

ul {
  list-style-type: none;
}
</style>