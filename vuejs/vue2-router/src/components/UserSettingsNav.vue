<template>
	<div id="userNav">
		<router-link to='/settings/email/1'>Email</router-link> | 
		<router-link :to="{name: 'profile', params: {profile_id: '1'} }">Profile</router-link>
	</div>
</template>