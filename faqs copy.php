<?php 
session_start();
require_once('php/connect.php');
?>

<?php require('./layout/header.php') ?>

    <div class="container">
        <div class="p-5 text-center rounded-3 mt-5">
            <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Frequently Asked Questions</h1>
            <hr class="featurette-divider" />
        </div>
    </div>

    <div class="bg-kabarkadogs-2 marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-12">
            <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
              GENERAL Frequently Asked Questions
            </h2>
            <p class="lead color-kabarkadogs pt-5" style="text-align: justify !important;">
              Please take the time to search the Frequently Asked Question below. Our staff cannot respond immediately to phone or email inquiries. Thank you. Please call only if absolutely necessary, and only if your concern is not addressed in our Frequently Asked Questions. It is best to message us.
            </p>
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>

    <div class="bg-kabarkadogs marketing">
      <div class="container">
        <div class="row featurette">
          <div class="col-md-6">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading1">
                      <button
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse1"
                      >
                        Q: Can you adopt my pet?
                      </button>
                    </h2>
                    <div
                      id="collapse1"
                      class="accordion-collapse collapse show"
                      aria-labelledby="heading1"
                      data-bs-parent="#faqAccordion"
                    >
                      <div class="accordion-body">
                        A: We do not adopt anymore, so we increase our responsibility, so we can be responsible for taking care of animals, not just surrendering them when they don't want to and whether they are sick or old.
                      </div>
                    </div>

              </div>
      
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse2"
                  >
                    Q: Can I return my adopted pet if I change my mind?
                  </button>
                </h2>
                <div
                  id="collapse2"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: It takes a lifetime to care for a pet. Please don't leave your adopted pet with strangers or on the streets, though, if you are genuinely unable to care for them. Please give them back to us so we can find them a new home. 
                  </div>
                </div>
              </div>
      
              <div class="accordion-item">
                <h2 class="accordion-header" id="heading3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse3"
                  >
                    Q: I live in the province/abroad. Can I still adopt?
                  </button>
                </h2>
                <div
                  id="collapse3"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading3"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: Absolutely, however depending on where you are, specific plans may need to be made for the meet-and-greet. For a discussion of your choices, please contact us. Another option is to adopt from your neighborhood pound.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse4"
                  >
                    Q: If I see an abused animal how do I report it?
                  </button>
                </h2>
                <div
                  id="collapse4"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: For any concerns regarding animal mistreatment, dog meat trade, or animal deaths, contact the Animal Kingdom Foundation by calling 911 or visiting the City Veterinary Office.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse5"
                  >
                    Q: Can my adoption request be turned down?
                  </button>
                </h2>
                <div
                  id="collapse5"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: Indeed. Applications may be rejected for a variety of reasons, such as the applicant's inability to keep their pet indoors, the pet's incompatibility with the home, or other situations that could endanger the well being, safety, or happiness of our shelter animals. 
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse6"
                  >
                    Q: How can I volunteer for The Kabarkadogs?
                  </button>
                </h2>
                <div
                  id="collapse6"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: Anyone with the ability and willingness to volunteer can do so by messaging our page.

Feeding stray animals might seem like a good deed, but it will only make them more common in the community and possibly make them considered pests in the long run.
Instead, we highly recommend that you set up a TNR (Trap-Neuter-Return) program and educate yourself on the subject of responsible feeding.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse7"
                  >
                    Q: Are spay and neuter procedures free of charge?
                  </button>
                </h2>
                <div
                  id="collapse7"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: Every year, the shelter provides free kapon. For information on when the next one is scheduled and how to register, please follow us on Facebook. 
Another option is to work with your local government unit (LGU) to arrange a kapon outreach in your community. 
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header" id="heading2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse8"
                  >
                    Q: Can you help me find my lost pet?
                  </button>
                </h2>
                <div
                  id="collapse8"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading2"
                  data-bs-parent="#faqAccordion"
                >
                  <div class="accordion-body">
                    A: The Kabarkadogs can assist by posting your lost pet ad on our Facebook page. Just send us your pet’s info and we shall make the announcement.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <img src="uploads/donate_dog_pic.png" width="99%" height="99%">
          </div>
          <hr class="featurette-divider" />
        </div>
      </div>
    </div>
<?php require('./layout/footer.php')?>