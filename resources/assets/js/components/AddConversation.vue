<template>
  <div class="">
    <form class="" action="" method="" @submit.prevent="handleChat">
      <input type="text" name="message" value="" v-model="message">
      <button type="submit" name="button">Submit</button>
    </form>

  </div>
</template>

<script>
export default {
  data: function(){
    return {
      message: ''
    }
  },

  methods: {
    handleChat: function(){
      if(this.message !== ''){
        console.log(this.message)
      }
    }
  }
}
</script>

<style lang="scss">

</style>
