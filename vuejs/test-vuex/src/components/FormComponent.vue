<template>
	<div>
		<label for="flovar">Favorite ice cream flavor?</label>
		<input @input='changed' type="text" name="flavor">
	</div>
</template>

<script>
	export default {
		methods: {
			changed: function(event) {
				this.$store.commit('change', event.target.value)
			}
		}
	}
</script>