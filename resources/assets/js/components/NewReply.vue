<template>
  <div class="hero main-card-top">
  <article class="media">
    <div class="media-content">
      <div v-if="signedIn">
        <div class="field">
          <p class="control">
            <!--<textarea class="textarea {{ $errors->has('body') ? 'is-danger' : '' }}" placeholder="Have Something to say?" name="body" id="body"></textarea>-->
            <textarea class="textarea" placeholder="Have Something to say?"
              name="body" id="body" v-model="body" required></textarea>
            <!--@if ($errors->has('body'))-->
          <!--<p class="help is-danger">{{ $errors->first('body') }}</p>-->
          <!--@endif-->
          </p>
        </div>
        <nav class="level">
          <div class="level-left">
            <button class="button is-info" type="submit" @click="addReply">Post
            </button>
          </div>
        </nav>
      </div>
      <div v-else>
        <p>Please <a href="/login">sign in</a> to participate in this
          discussion</p>
      </div>
    </div>
  </article>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        body: '',
      }
    },
    computed: {
      signedIn() {
        return window.App.signedIn
      }
    },
    methods: {
      addReply() {
        axios.post(location.pathname + '/replies', {body: this.body})
          .then(({data}) => {
            this.body = '';
            flash('Your reply has been posted.');
            this.$emit('created', data);
          });
      }
    }
  }
</script>
