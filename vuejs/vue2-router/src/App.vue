<template>
	<div class="container p-5">
		<h1>Nested Named View</h1>
		<router-link to='/'>Home</router-link> | 
		<router-link to='/settings'>User Settings</router-link>
		<router-view></router-view>

	</div>
</template>

<script>
	export default {
		name: 'App',

	}	
</script>
