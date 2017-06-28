<template lang="html">
  <div class="privateMessage privatemessage-inbox">
    <section class="header">
      <h3>Compose Private Message <small>compose a private message.</small></h3>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <sidebar></sidebar>
        </div>
        <div class="col-sm-7">
          <form class="formSubmit" @submit.prevent="handleFormSubmit()">
            <div class="form-group">
              <label for="">Select a user: </label>
              <multiselect
                v-model="pm.userSelected"
                :options="options"
                :multiple="true"
                :searchable="true"
                :close-on-select="true"
                :show-labels="false"
                track-by="id"
                label="name"
                placeholder="Select a User"
               ></multiselect>
            </div>

            <div class="form-group">
              <label>Subject</label>
              <input type="text" v-model="pm.subject" placeholder="Enter Subject" class="form-control">
            </div>

            <div class="form-group">
              <label>Message</label>
              <textarea name="message" v-model="pm.message" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <button type="submit" name="button" class="btn btn-primary">Send</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
    import sidebar from './Sidebar'
    import multiselect from 'vue-multiselect'

  // register globally
  Vue.component(multiselect)
    export default {
      components: {
        sidebar,
        multiselect
      },

      data: function(){
        return {
          pm: {
            userSelected: '',
            subject: '',
            message: ''
          },
          pusher: null,
          channel: null,
          allUsers: [],
          options: [],
          userStore: []
        }
      },

      mounted: function(){
        axios.get('/users').then(response => {
          this.userStore = response.data;
          var app = this;
          this.options = Object.values(this.userStore);
          // console.log(this.options);
        });
      },

      created: function(){
        Echo.join('chatroom')
            .here()
            .joining()
            .leaving()
            .listen('MessagePosted', (e) => {
              console.log(e);
            });
      },

      methods: {
        handleFormSubmit: function(){
          let postData = {
            'receiver_id': this.pm.userSelected[0].id,
            'message': this.pm.message,
            'subject': this.pm.subject
          };

          axios.post('/sendPrivateMessage', postData).then(response => {
            this.$router.push('/sent');
            // console.log(response.data);
          });
          // console.log(this.pm.userSelected[0].id)
        },

        incomingChat: function(chatMessage){
          console.log(this.pm.userSelected.id);
        }
      }
    }
</script>
