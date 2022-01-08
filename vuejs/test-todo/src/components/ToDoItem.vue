<template>
	<div v-if="!isEditing">
		<div class="row mb-3">
			<div class="col form-check">
				<input type="checkbox" class="form-check-input" 
				:id="id" 
				:checked="isDone" 
				@change="$emit('checkbox-changed')" /> 
				<label :for="id" class="form-check-label"> {{ label }}</label>
			</div>
			<div class="col-4">
				<button class="btn btn-outline-success me-1" type="button" ref="editButton" @click="toggleToItemEditForm">Edit<span class="visually-hidden"> {{ label }}</span>
				</button>
				<button class="btn btn-outline-danger" type="button" @click="deleteToDo">Delete <span class="visually-hidden"> {{ label }}</span>
				</button>
			</div>
		</div>
	</div>
	<to-do-item-edit-form
		v-else
		:id="id"
		:label="label"
		@item-edited="itemEdited"
		@edit-cancelled="editCancalled"
	>	
	</to-do-item-edit-form>
</template>

<script>
import ToDoItemEditForm from './ToDoItemEditForm.vue'

	export default {
		components: {
			ToDoItemEditForm
		},
		props: {
			label: { required: true, type: String},
			id: { required: true, type: String },
			done: { default: false, type: Boolean}
		},
		data() {
			return {
				isEditing: false
			}
		},
		methods: {
			deleteToDo() {
				this.$emit("item-deleted");
			},
			toggleToItemEditForm() {
				// console.log(this.$refs.editButton);
				this.isEditing = true;
			},
			itemEdited(newLabel) {
				this.$emit("item-edited", newLabel);
				this.isEditing = false;
			},
			editCancalled() {
				this.isEditing = false;
			},

		},
		computed: {
			isDone(){
				return this.done;
			}
		}
	}
</script>