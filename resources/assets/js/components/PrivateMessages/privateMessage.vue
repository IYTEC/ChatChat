<template lang="html">
  <div class="privatemessage privatemessage-inbox">
    <section class="header">
      <h1>Private Message Section <small>My Private Messages</small></h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <sidebar></sidebar>
        </div>
        <div class="col-sm-7">
          <table class="table table-striped table-hover table-bordered table-condensed message-table">
            <thead>
              <tr>
                <th class="col-sm-3">Receiver Name</th>
                <th class="col-sm-6">Message Subject</th>
                <th class="col-sm-3">Time ago</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="message in messagesRec" :class="[message.read == 0 ? 'unread' : 'read']">
                <td class="col-sm-3">{{message.sender.name}}</td>
                <td class="col-sm-7"><router-link :to="{name: '/pms', params: {id: message.id}}">{{message.subject}}</router-link></td>
                <td class="col-sm-3">{{message.created_at}}</td>
              </tr>
            </tbody>
          </table>
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
      authenticated: '',
      notifications: [],
      messagesRec: [],
      messagesSent: [],
      message: {
        subject: '',
        message: '',
        sender: ''
      }
    }
  },

  mounted: function(){
    axios.get('/signedinuser').then(response => {
      this.authenticated = response.data;
    });

    axios.post('/getPrivateMessages').then(response => {
      this.messagesRec = response.data;
    });
  }
}
</script>

<style lang="css">
</style>
