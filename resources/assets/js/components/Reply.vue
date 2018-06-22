<template>
    <div :id="'reply-' + id" class="card reply-item-top">
      <header class="card-header">
        <p class="card-header-title">
          <a :href="'/profiles/'+ data.owner.name" v-text="data.owner.name">
          </a> said:
          <span v-text="ago"></span>
        </p>
        <div v-if="signedIn">
          <favorite :reply="data"></favorite>
        </div>
      </header>
      <div class="card-content">
        <div class="content">
          <div v-if="editing">
            <textarea class="textarea" v-model="body"></textarea>
            <div class="container reply-btn-padding">
              <button class="button is-info" @click="update">Update</button>
              <button class="button is-danger" @click="editing = false">Cancel</button>
            </div>
          </div>
          <div v-else v-text="body"></div>
        </div>
      </div>
      <footer class="card-footer" v-if="canUpdate">
        <a class="card-footer-item" @click.prevent="editing = true">
          Edit</a>
        <a class="card-footer-item" @click.prevent="destroy">Delete</a>
      </footer>
    </div>
</template>
<script>
  import Favorite from './Favorite.vue';
  import moment from 'moment';

  export default {
    props: ['data'],
    components: { Favorite },
    data() {
      return {
        editing: false,
        id: this.data.id,
        body: this.data.body
      }
    },
    computed: {
      signedIn() {
        return window.App.signedIn
      },
      canUpdate() {
        return this.authorize(user => this.data.user_id === user.id);
      },
      ago() {
        return moment(this.data.created_at).fromNow();
      }
    },
    methods: {
      update() {
        axios.patch('/replies/' + this.data.id, {
          body: this.body
        }).catch(error => {
          flash(error.response.data, 'danger');
        });
        this.editing = false;
        flash('Updated!');
      },
      destroy() {
        axios.delete('/replies/' + this.data.id);
        this.$emit('deleted', this.data.id);
      }
    }
  }
</script>

