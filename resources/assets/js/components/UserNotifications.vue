<template>
  <div class="navbar-item has-dropdown is-hoverable" href="/"
    v-if="notifications.length">
    <a href="#" class="navbar-item is-white">
      <span class="icon">
        <i class="ion-md-notifications"></i>
      </span>
    </a>
    <div class="navbar-dropdown is-right is-boxed">
      <div class="navbar-item" v-for="notification in notifications">
        <a :href="notification.data.link" v-text="notification.data.message"
          @click="markAsRead(notification)"
        ></a>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        notifications: false
      }
    },
    created() {
      axios.get('/profiles/' + window.App.user.name + '/notifications')
        .then(response => this.notifications = response.data)
    },
    methods: {
      markAsRead(notification) {
        axios.delete('/profiles/' + window.App.user.name
          +'/notifications/' + notification.id)
      }
    }
  }
</script>