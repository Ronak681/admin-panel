@extends('frontend.layout.main')
@section('content')

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d113903.77464428594!2d75.72752612603415!3d26.85607491904716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x396db6062f674e5f%3A0xf4a6c1e8cb91bccc!2s39%2C%20Pradhan%20Marg%2C%20Vidhyut%20Abhiyanta%20Colony%2C%20Block%20C%2C%20Malviya%20Nagar%2C%20Jaipur%2C%20Rajasthan%20302017!3m2!1d26.8560387!2d75.8099027!5e0!3m2!1sen!2sin!4v1729752084851!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            @foreach ($contact as $contact)
                            <li>
                                <h4>{{ $contact->country }}</h4>
                                <p>{{ $contact->address }} <br />{{ $contact->phone }}</p>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form id="contactForm" action="{{ route('sent.message')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                                    <p class="invalid-feedback text-danger" style="display: none;"></p>

                                </div>
                                <div class="col-lg-6">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                                   
                                    <p class="invalid-feedback text-danger" style="display: none;"></p>
                                   
                                </div>
                                <div class="col-lg-12">
                                    <textarea id="message" name="message" class="form-control" placeholder="Message"></textarea>
                                    <p class="invalid-feedback text-danger" style="display: none;"></p>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault(); 
            $('.invalid-feedback').hide();
        $('.form-control').removeClass('is-invalid');


            $.ajax({
                url: $(this).attr('action'),
                type: 'POST', 
                data: $(this).serialize(),
                success: function(response) {
                   toastr.success(response.success);
                    $('#contactForm')[0].reset(); 
                },
                error: function(xhr) {
                    console.log('Error response:', xhr);
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                $(`#${key}`).removeClass('is-invalid');
                                $(`#${key}`).next('.invalid-feedback').hide();

                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}`).next('.invalid-feedback').text(value[0]).show();
                            });
                        }
                  
                    }
                }
            }); 
        });
    });
</script>
@endsection