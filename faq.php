<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="en-US">
    <?php
    include("php/session.inc.php");
    include("php/header.inc.php");
    ?>
    <div class="container">
        <br><br>
        <img src="images/faq.jpg" class="img-fluid" alt="Responsive image">
    </div>
    <div class="container">
        <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                <div class="card">
                    <div class="card-header" role="tab" id="headingOne1">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                           aria-controls="collapseOne1">
                            <h5 class="mb-0">
                                What should I do if my tickets are lost or stolen? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                         data-parent="#accordionEx">
                        <div class="card-body">
                            To expedite resolutions to lost/stolen tickets, please prepare the following before calling +65 6348 5555 for assistance:

                            - Transaction number
                            - Event title
                            - Number of tickets purchased
                            - Name and contact no./email


                            Only tickets for reserved seating can be replaced for a service fee of $5.00 per ticket.
                            Lost / Stolen General Admission (GA) tickets cannot be replaced. 
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingTwo2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                            <h5 class="mb-0">
                                What are my payment options? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                         data-parent="#accordionEx">
                        <div class="card-body">
                            We accept PayPal, Visa, MasterCard, Discover, and American Express.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingThree3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                            <h5 class="mb-0">
                                How long does it take for tickets to reach me by mail? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                         data-parent="#accordionEx">
                        <div class="card-body">
                            Processed tickets are dispatched the following working day. If your tickets do not reach you within 7 working days, please call +65 1234 5678 or email us via our Feedback Form for assistance. 
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingFour4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
                            <h5 class="mb-0">
                                How safe is it to order online? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <div id="collapseFour4" class="collapse" role="tabpanel" aria-labelledby="headingFour4"
                         data-parent="#accordionEx">
                        <div class="card-body">
                            We only use the safest payment processing services on the web. If you have any security questions or concerns please check out our payment processors security measures. PayPal.com or Shopify Payments
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" role="tab" id="headingFive5">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5" aria-expanded="false" aria-controls="collapseFive5">
                            <h5 class="mb-0">
                                Can I refund my ticket? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5"
                         data-parent="#accordionEx">
                        <div class="card-body">
                            Refund procedures are dictated by audit rules where refunds have to be made corresponding to the mode of payment when tickets were purchased.
                            For example, credit card accounts will be automatically credited (refunded) directly for cancelled events paid for using credit cards. For cash transactions, stringent cash security rules have to be met. Most times large sums of cash are required to fulfill refund requirements. In a major refund exercise many counters may also be required to provide prompt service. In addition, audit controls require a strict refund verification procedure.
                            Currently, only our office located at the 10 Eunos Road 8, #03-04, Singapore Post Centre, Singapore 408600 can meet all these requirements and provide dedicated counters to efficiently fulfill all refund obligations. 
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="headingSix6">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix6" aria-expanded="false" aria-controls="collapseSix6">
                        <h5 class="mb-0">
                            Can I choose my seats when purchasing over the internet? <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseSix6" class="collapse" role="tabpanel" aria-labelledby="headingSix6"
                     data-parent="#accordionEx">
                    <div class="card-body">
                        You are able to select for your preferred category and section (subject to availability) for all events.  Our ticketing system will allocate the next available seats at your point of transaction to accelerate the booking process. Seat selection is available through the ‘Pick Your Own (PYO)’ seat functionality, which is only available for events where event organisers have given their consent.​ 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <!-- Section: Contact us -->
        <section>
            <img class="contactus2img img-fluid" src="images/contactus2.jpg" alt="contactus2">
            <!-- Section description -->
            <p class="text-center w-responsive mx-auto mb-5">
                Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within a matter of hours to help you.
            </p>

            <div class="row">
                <div class="col-md-9">
                    <form action="process_feedback.php" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="feedback_name" placeholder="Your Name"  required class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name ="feedback_email" placeholder="Email"  required class="form-control">
                            </div>

                            <div class="col-md-12">
                                <input type="text" name="feedback_subject" placeholder="Subject"  required class="form-control">
                            </div>

                            <div class="col-md-12">                                  
                                <textarea name="feedback_message" class="form-control"  placeholder="Your Message"  required rows="3"></textarea>                                 
                            </div>
                        </div>                                            
                        <button type="submit" class="btn btn-success btn-md">Send Message</button>
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-2 text-center">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <i class="fa fa-map-marker fa-2x blue-text"></i>
                            <p>172 Ang Mo Kio Avenue 8, 567739</p>
                        </li>
                        <li>
                            <i class="fa fa-phone fa-2x mt-4 blue-text"></i>
                            <p>+65 87654321</p>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-2x mt-4 blue-text"></i>
                            <p class="mb-0">faq@neptune.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <?php
    include("php/footer.inc.php");
    ?>
</body>
</html>
