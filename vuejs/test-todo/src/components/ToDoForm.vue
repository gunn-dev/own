<template>
	<form @submit.prevent="onSubmit">
		<h3>
			What needs to be done?
		</h3>
		<input type="text"
			id="new-todo-input"
			name="new-todo"
			autocomplete="off"
			v-model.lazy.trim="label" 
			class="form-control" 
		>
		<div class="d-grid d-block my-2">
			<button class="btn btn-secondary">Add</button>
		</div>
	</form>
</template>

<script>
	export default {
		methods: {
			onSubmit() {
				if(this.label == "") {
					return;
				}
				this.$emit('todo-added', this.label);
				this.label = "";
			}
		}, 
		data() {
			return {
				label: ""
			};
		}
	}
</script>