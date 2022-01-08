<template>
	<div id="userprofile" class="card p-5 my-2">
		<h3>User Profile</h3>
		<p>Profile id: {{ profile_id }}</p>
		<!-- <p>Profile id: {{ this.$route.params.profile_id }}</p> -->

	</div>
</template>

<script>
	export default {
		props: ['profile_id']
	}
</script>