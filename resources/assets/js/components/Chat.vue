<template>
  <div class="">
    <h3>Chat area</h3>
    <div class="col-xs-4">
      <userlist @clicked="childValue"></userlist>
    </div>
    <div class="col-xs-8">
      <div class="conversation" v-for="chat in conversations">
        <div class="sender-data clearfix">
          <div class="name">{{chat.sender.name}}</div>
          <div class="time">{{chat.created_at}}</div>

          <div class="chat-body">
            {{chat.chat}}
          </div>
        </div>
      </div>
      <form class="" action="" method="" @submit.prevent="handleChat">
        <input type="text" placeholder="Enter your message here" v-model="message">
        <button type="submit" name="button">Submit</button>
      </form>
      <!-- <inputconversation></inputconversation> -->
    </div>
  </div>
</template>

<script>
import userlist from './Userlist';
// import inputconversation from './AddConversation';
export default {
  components: {
    userlist
    // inputconversation
  },

  data: function() {
    return {
      conversations: [],
      authenticatedUser: '',
      currentchatUser: '',
      message: ''
    }
  },

  methods: {
    childValue: function(value) {
      this.conversations = value[0];
      this.authenticatedUser = value[1];
      this.currentchatUser = value[2];
      // console.log(this.currentchatUser);
    },

    handleChat: function(){
      let app = this;
      if(this.message !== ''){
        let postdata = {
          'receiver_id': this.currentchatUser,
          'chat': this.message
        };

        axios.post('/saveChat', postdata).then(response => {
          this.message = ''
        });
        // this.conversations.push(this.message);
        console.log(this.conversations);
        // console.log(postdata);

      }
    }
  }
}
</script>

<style lang="css">
</style>
