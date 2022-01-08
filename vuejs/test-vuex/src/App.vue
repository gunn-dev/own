<template>
  <div id="app">
    <Form />
    <Display />
  </div>
</template>

<script>
import Form from './components/FormComponent'
import Display from './components/DisplayComponent'

export default {
  name: 'App',
  components: {
    Form, 
    Display
  }
}
</script>

