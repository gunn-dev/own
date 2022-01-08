<template>
  <div id="nav">
    <router-link to="/about">About</router-link> |
    <router-link :to="{name: 'profile', params: { username: 'mark 2021' } }">Profile</router-link> |
    <router-link to="/product/12/Computer Science">Product</router-link> |
    <button @click="change">About</button> 
  </div>
  <router-view/>
</template>


<script>
  export default {
    methods: {
      change() {
        this.$router.push('about');
      }
    }
  }
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
