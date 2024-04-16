<style>
.wrapperreview {
  width: 100%;
  padding: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;

  border-radius: 20px;
  box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.2);
  background-color: rgba(255, 255, 255, 0.5);
  z-index: 1;
}
.wrapperreview .title {
  font-weight: bold;
  font-size: 30px;
}
.wrapperreview .content {
  line-height: 1.6;
  color: #555;
  font-size: 15px;
  margin-bottom: 20px
}

.rate-boxreview {
  display: flex;
  flex-direction: row-reverse;
  gap: 0.1rem;
}
.rate-boxreview input {
  display: none;
}
.rate-boxreview input:hover ~ .star:before {
  color: rgba(255, 204, 51, 0.5);
}
.rate-boxreview input:active + .star:before {
  transform: scale(0.9);
}
.rate-boxreview input:checked ~ .star:before {
  color: #ffcc33;
  text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
}
.rate-boxreview .star:before {
  content: "★";
  display: inline-block;
  font-family: "Potta One", cursive;
  font-size: 40px;
  cursor: pointer;
  color: #0000;
  text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.5);
  background-color: #aaa;
  background-clip: text;
  -webkit-background-clip: text;
  transition: all 0.3s;
}

.reviewtext,input {
  border: none;
  resize: none;
  width: 100%;
  padding: 0.2rem;
  color: inherit;
  font-family: inherit;
  line-height: 1.5;
  border-radius: 0.2rem;
  box-shadow: inset 2px 2px 8px rgba(0, 0, 0, 0.3), inset -2px -2px 8px rgba(255, 255, 255, 0.8);
  background-color: rgba(255, 255, 255, 0.3);
}
.reviewtext::placeholder {
  color: #aaa;
}
.reviewtext:focus {
  outline-color: #ffcc33;
}

.submit-btnreview {
  padding: 10px 40px;
  box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.3), -3px -3px 8px rgba(255, 255, 255, 0.8);
  border-radius: 1rem;
  cursor: pointer;
  background-color: rgba(255, 204, 51, 0.8);
  transition: all 0.2s;
  margin-top: 30px
}
.submit-btnreview:active {
  transform: translate(2px, 2px);
}
</style>
<form action="{{ route('review.user') }}" method="post">
    @csrf
    <input type="hidden" name="form-type" value="hotels">
    <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">

<div class="wrapperreview">
    <div class="title">Rate your experience</div>
    <div class="content">We highly value your feedback! Kindly take a moment to rate your experience and provide us with your valuable feedback.</div>
    @auth
    <input type="hidden" name="user_id" value="{{ auth()->user()->id}}">
    <input type="text" name="review-name" value="{{ auth()->user()->name }}" disabled placeholder="Enter Name" class="form-control mb-2" required >
    <input type="email" value="{{ auth()->user()->email }}" disabled name="review-email" placeholder="Enter Email" class="form-control" required >
    <div class="rate-boxreview">
      <input type="radio" name="star_review" value="5" id="star0"/>
      <label class="star" for="star0"></label>
      <input type="radio" name="star_review" value="4" id="star1"/>
      <label class="star" for="star1"></label>
      <input type="radio" name="star_review" value="3" id="star2"/>
      <label class="star" for="star2"></label>
      <input type="radio" name="star_review" value="2" id="star3"/>
      <label class="star" for="star3"></label>
      <input type="radio" name="star_review" value="1" id="star4"/>
      <label class="star" for="star4"></label>
    </div>
    <textarea required class="reviewtext" name="message" cols="30" rows="6" placeholder="Tell us about your experience!"></textarea>
    <button type="submit" class="submit-btnreview" >Send Feedback</button>
    @else
    <div class="content">To leave a review you have to be registered first , to create and account please <a style="color:aqua" href="{{ route('front.login') }}"> click here</a></div>
    @endauth
  </div>
</form>
