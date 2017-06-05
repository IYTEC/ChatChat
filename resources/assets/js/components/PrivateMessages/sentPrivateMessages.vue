<template lang="html">
  <div class="privateMessage privatemessage-inbox">
    <section class="header">
      <h3>Private messages sent <small>Sent private messages.</small></h3>
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
                <th class="col-sm-3">Sender Name</th>
                <th class="col-sm-6">Message Subject</th>
                <th class="col-sm-3">Time ago</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="message in messagesSent">
                <td class="col-sm-3">{{message.receiver.name}}</td>
                <td class="col-sm-7"><router-link :to="{name: '/pms', params: {id: message.id}}">{{message.subject}}</router-link></td>
                <td class="col-sm-2">{{message.created_at}}</td>
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

      data: function() {
        return {
          messagesSent: []
        }
      },

      mounted: function() {
        axios.post('/getPrivateMessagesSent').then(response => {
          this.messagesSent = response.data;
          console.log(response.data)
        });
      }
    }
</script>
