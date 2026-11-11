@include('include.header')

    <!-- Hero Section -->
    <section class="mainBanner">
        <div class="hero-banner">
            <img src="assets/images/hero-banner.png" alt="" style="height: 400px;">
        </div>
        <div class="hero-content">
            <h1 class="fw-bold display-5 text-white">REDEFINING LEATHER<br>CRAFTSMANSHIP</h1>
            <p class="lead text-white">YOUR JOURNEY BEGINS WITH PLLOHIDE</p>
        </div>
    </section>

<section class="survey section-py-50 bg-white">
        <div class="container">
  <div class="row">
    <div class="serveyHeading">
        <h2 class="text-left">Shaping the Future of Leather Innovation – PlloHide Wants Your Feedback!</h2>
    <p class="text-muted text-left">
      At PlloHide, we are revolutionizing the leather industry by blending cutting-edge technology 
      with traditional craftsmanship while promoting sustainability. Your insights help us refine our offerings!
    </p>
    </div>
    </div>
    <div class="row mt-3">

      <form action="{{ route('survey.store') }}" method="POST">
    @csrf
      <!-- Section 1 -->
      <h3>1. About You:</h3>

      <div class="input-type">
        <label class="form-label">What best describes your role in the leather industry?</label>
        <select class="form-select" name="role">
          <option value="">Select</option>
          <option value="designer">Designer</option>
          <option value="manufacturer">Manufacturer</option>
          <option value="supplier">Supplier</option>
          <option value="retailer">Retailer</option>
          <option value="consumer">Consumer/Leather Enthusiast</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="input-type">
        <label class="form-label">How often do you work with leather or leather alternatives?</label>
        <select class="form-select" name="frequency">
          <option value="">Select</option>
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
          <option value="occasionally">Occasionally</option>
          <option value="rarely">Rarely</option>
        </select>
      </div>

      <!-- Section 2 -->
      <h3>2. Leather Industry Challenges:</h3>

      <div class="input-type">
        <label class="form-label">Biggest challenges you face in sourcing or working with leather?</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="challenges" value="high_costs" id="highCosts">
          <label class="form-check-label" for="highCosts">High costs</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="challenges" value="limited_sustainable" id="limitedSustainable">
          <label class="form-check-label" for="limitedSustainable">Limited access to sustainable leather</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="challenges" value="lack_transparency" id="lackTransparency">
          <label class="form-check-label" for="lackTransparency">Lack of transparency in supply chains</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="challenges" value="finding_skilled" id="findingSkilled">
          <label class="form-check-label" for="findingSkilled">Difficulty finding skilled manufacturers</label>
        </div>
        <div class="form-check d-flex align-items-center gap-2 mt-2 flex-wrap">
          <input class="form-check-input" type="checkbox" name="challenges" value="other" id="otherChallenge">
          <label class="form-check-label" for="otherChallenge">Other</label>
          <div class="otherInput">
            <input type="text" class="form-control form-control-sm w-50" name="other_challenges" placeholder="Specify">
          </div>
          
        </div>
      </div>

      <div class="input-type">
        <label class="form-label">How important is sustainability when choosing leather products?</label>
        <select class="form-select" name="sustainability_importance">
          <option value="">Select</option>
          <option value="extremely_important">Extremely important</option>
          <option value="somewhat_important">Somewhat important</option>
          <option value="neutral">Neutral</option>
          <option value="not_important">Not important</option>
        </select>
      </div>

      <div class="input-type">
        <label class="form-label">What offerings from PlloHide interest you?</label>
        <select class="form-select" name="pllohide_offerings">
          <option value="">Select</option>
          <option value="sustainable_leather">Sustainable Leather</option>
          <option value="dnwkndndw">dnwkndndw</option>
          <option value="wdlkwdk">wdlkwdk</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="input-type">
        <label class="form-label">Are you interested in joining our platform?</label>
        <select class="form-select" name="platform_interest">
          <option value="">Select</option>
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>

      <div class="input-type">
        <label class="form-label">What is your main preference?</label>
        <input type="text" class="form-control mb-2" name="preference1" placeholder="">
        <input type="text" class="form-control" name="preference2" placeholder="">
      </div>

      <div class="input-type">
        <label class="form-label">Would you like to give feedback?</label>
        <select class="form-select" name="feedback">
          <option value="">Select</option>
          <option value="yes">Yes</option>
          <option value="no">No</option>
        </select>
      </div>

      <div class="input-type">
        <label class="form-label">Any other notes?</label>
        <input type="text" class="form-control" name="other" placeholder="">
      </div>

      <!-- Section 5 -->
      <h3>5. Feedback & Suggestions:</h3>
      <div class="input-type">
        <label class="form-label">Improvements or services you'd like to see?</label>
        <textarea class="form-control" name="improvements" rows="4" placeholder="Your thoughts"></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn px-5">Submit</button>
      </div>
    </form>
  </div>
</div>
    </section>



   @include('include.footer')
