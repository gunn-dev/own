<template>
	<div>
		<h1>Product Page</h1>
		<router-link to='/'>Home</router-link>
	</div>
	<span>
		Looking for Product: {{ this.$route.params.id }}
	</span>
	<p>
		Product Category: {{ this.$route.params.category }}
	</p>
</template>