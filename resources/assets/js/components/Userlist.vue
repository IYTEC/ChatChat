<template>
  <div class="">

    <ul class="list-group">
      <li
        class="list-group-item"
          :class="[{active: userActive(user)}]"
        @click="chatUser(user)"
        v-for="user in users"
        v-if="authuser.name != user.name"
        >
        {{user.name}}
      </li>
    </ul>
  </div>
</template>

<script>
export default {

  data: function(){
    return {
      users: [],
      authuser: '',
      currentchatUser: ''
    }
  },

  methods: {
    userActive: function(user){
      if(this.currentchatUser == user.id){
        return true;
      }
      return false;
    },

    chatUser: function(user){
      this.currentchatUser = user.id;
      let app = this;
      axios.post('/getUserConversation', user)
      .then(response => {
        app.$emit('clicked', [response.data, app.authuser, app.currentchatUser]);
      }).catch(errors => {
        console.log(response.errors)
      });

    }

  },

  mounted: function(){
      axios.get('/signedinuser').then(response => {
        this.authuser = response.data;
        // console.log(response.data);
      });

      axios.get('/users').then(response => {
        this.users = response.data;
        console.log(response.data);
      });

  }
}
</script>

<style lang="css">
</style>
