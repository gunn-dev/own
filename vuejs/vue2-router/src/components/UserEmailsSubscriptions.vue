<template>
	<div id="email" class="card p-5 my-2">
		<h3>Email Subscriptions</h3>
		<p>Email ID: {{ id }}</p>
		<!-- <p>Email ID: {{ this.$route.params.id }}</p> -->

	</div>
</template>

<script>
	export default {
		props: [ 'id' ]
	}
</script>