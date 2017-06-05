<template lang="html">
  <div class="privatemessage privatemessage-inbox">
    <section class="header">
      <h1>See Message <small>The Message</small></h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <sidebar></sidebar>
        </div>
        <div class="col-sm-7">
          <h3>{{pmStore.subject}}</h3>
          <p>From: {{pmStore.sender.email}} <span class="pull-right">{{pmStore.created_at}}</span></p>
          <div class="message">
            {{pmStore.message}}
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import sidebar from './Sidebar'
export default {
  components: {
    sidebar
  },

  data: function(){
    return {
      pmStore: ''
    }
  },

  created: function(){
    let postData = {'id': this.$route.params.id };
    axios.post('/getPrivateMessage', postData).then(response => {
      this.pmStore = response.data;
      console.log(this.pmStore);
    });
  }
}
</script>

<style lang="css">
</style>
