@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'map'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card demo-icons">
                    <div class="card-header">
                        <h5 class="card-title">ADD DOCTORS</h5>
                        <div class="card-body">
                        <form id="addDoctorForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                            </div>
                            <div class="form-group">
                                <label for="speciality">Speciality</label>
                                <select class="form-control" id="speciality" name="speciality" required>
                                    <option value="">---Select Speciality---</option>
                                    <option value="Allergy and Immunology">Allergy and Immunology</option>
                                    <option value="Anesthesiology">Anesthesiology</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Emergency Medicine">Emergency Medicine</option>
                                    <option value="Endocrinology">Endocrinology</option>
                                    <option value="Family Medicine">Family Medicine</option>
                                    <option value="Gastroenterology">Gastroenterology</option>
                                    <option value="Geriatrics">Geriatrics</option>
                                    <option value="Hematology">Hematology</option>
                                    <option value="Infectious Disease">Infectious Disease</option>
                                    <option value="Internal Medicine">Internal Medicine</option>
                                    <option value="Medical Genetics">Medical Genetics</option>
                                    <option value="Nephrology">Nephrology</option>
                                    <option value="Neurology">Neurology</option>
                                    <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                                    <option value="Oncology">Oncology</option>
                                    <option value="Ophthalmology">Ophthalmology</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                    <option value="Otolaryngology">Otolaryngology</option>
                                    <option value="Pathology">Pathology</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Physical Medicine and Rehabilitation">Physical Medicine and Rehabilitation</option>
                                    <option value="Plastic Surgery">Plastic Surgery</option>
                                    <option value="Preventive Medicine">Preventive Medicine</option>
                                    <option value="Psychiatry">Psychiatry</option>
                                    <option value="Pulmonology">Pulmonology</option>
                                    <option value="Radiology">Radiology</option>
                                    <option value="Rheumatology">Rheumatology</option>
                                    <option value="Sports Medicine">Sports Medicine</option>
                                    <option value="Surgery">Surgery</option>
                                    <option value="Urology">Urology</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room_no">Room No.</label>
                                <input type="text" class="form-control" id="room_no" name="room_no" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Doctor's Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required>
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Doctor</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- @push('scripts')
    <script>
        $(document).ready(function() {
            demo.initGoogleMaps();
        });
  </script>
@endpush -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
            
            $('#addDoctorForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('doctors.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire('Success!', 'Doctor added successfully', 'success');
                        $('#addDoctorForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText
                        });
                    }
                });
            });
        });
    </script>
@endpush