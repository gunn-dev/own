<template>
	<form @submit.prevent="onSubmit">
		<div class="row mb-3">
		<div class="col">
			<input type="text" :id="id" ref="labelInput" autocomplete="off" v-model.lazy.trim="newLabel" class="form-control" />
		</div>
		<div class="col-4">
			<button class="btn btn-outline-success me-1" type="button" @click="onCancel">Cancel
        <span class="visually-hidden"> editing {{ label }}</span>
			</button>
			<button class="btn btn-outline-danger" type="submit" >Save
        <span class="visually-hidden"> edit for {{ label }}</span>
			</button>
		</div>
	</div>
	</form>
</template>

<script>
	export default {
		props: {
			label: {
				type: String,
				required: true
			},
			id: {
				type: String, 
				required: true
			}
		},
		data() {
			return {
				newLabel: this.label
			}
		},
		methods: {
			onSubmit() {
				if (this.newLabel && this.newLabel !== this.label) {
					this.$emit("item-edited", this.newLabel);
				}
			},
			onCancel() {
				this.$emit("edit-cancelled");
			},
		},
		mounted() {
			const labelInputRef = this.$refs.labelInput;
			labelInputRef.focus();
		}
	}
</script>