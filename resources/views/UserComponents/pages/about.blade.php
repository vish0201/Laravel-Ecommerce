@extends('UserComponents.Layouts.layout')



@section('content')

<style>

:root {
  --primary-color: #7AB2B2;
  --secondary-color: #4D869C;
  --background-color: #EEF7FF;
  --accent-color: #CDE8E5;
}

/* Apply colors to specific elements */
body {
  background-color: var(--background-color);
}

.section-title {
  color: var(--primary-color);
}

/* Example usage with a button */
.btn-primary {
  background-color: var(--primary-color);
  color: white;
}

.btn-secondary {
  background-color: var(--secondary-color);
  color: white;
}

/* Example usage with borders */
.border-primary {
  border-color: var(--primary-color);
}

.border-secondary {
  border-color: var(--secondary-color);
}

/* Example usage with text */
.text-primary {
  color: var(--primary-color);
}

.text-secondary {
  color: var(--secondary-color);
}

/* Example usage with background */
.bg-primary {
  background-color: var(--primary-color);
  color: white;
}

.bg-secondary {
  background-color: var(--secondary-color);
  color: white;
}

/* Example usage with gradient background */
.bg-gradient-primary {
  background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
  color: white;
}

/* Example usage with hover effects */
.btn-primary:hover,
.btn-secondary:hover {
  opacity: 0.8;
}

</style>
    


<section id="about" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="section-title">About Us</h2>
          <p>Welcome to [Your Company Name]! We are a team of passionate individuals dedicated to [brief description of your company's mission or purpose]. Our journey began [mention the founding story or year your company was established], and since then, we have been committed to [core values or goals of your company].</p>
          <p>At [Your Company Name], we strive for excellence in everything we do. Whether it's providing top-notch products, delivering exceptional services, or fostering a supportive work culture, our focus is always on [key areas of focus or specialization]. We believe in [mention any unique principles or beliefs that guide your company].</p>
          <p>Customer satisfaction is at the heart of our operations. We prioritize [mention specific ways you prioritize customer satisfaction, such as quality assurance, prompt support, etc.]. Our dedicated team works tirelessly to ensure that every interaction with [Your Company Name] exceeds expectations.</p>
          <p>Innovation is key to our success. We are continuously exploring new ideas and technologies to [mention how innovation drives your company forward]. Whether it's [mention any recent innovations or projects your company has undertaken], we are always pushing the boundaries to stay ahead in the ever-evolving [mention your industry or sector].</p>
        </div>
        <div class="col-md-6">
          <img src="https://via.placeholder.com/400" alt="About Us Image 1" class="img-fluid mb-4">
          <img src="https://via.placeholder.com/400" alt="About Us Image 2" class="img-fluid">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Our Values</h3>
          <ul class="list-unstyled">
            <li><strong>Integrity:</strong> We conduct ourselves with honesty and transparency in all our dealings.</li>
            <li><strong>Excellence:</strong> We strive for excellence in every aspect of our work, delivering superior quality at all times.</li>
            <li><strong>Innovation:</strong> We embrace innovation and constantly seek new and better ways to serve our customers.</li>
            <li><strong>Customer Focus:</strong> We are dedicated to understanding and meeting the needs of our customers, ensuring their satisfaction at every touchpoint.</li>
            <!-- Add more values as needed -->
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Our Commitment</h3>
          <p>At [Your Company Name], we are committed to [briefly reiterate your commitment to customers, quality, innovation, etc.]. With a focus on [mention any specific areas or initiatives your company is focused on], we are poised to [mention your company's vision for the future].</p>
          <p>Thank you for choosing [Your Company Name]. We look forward to serving you and building a lasting relationship based on trust, quality, and innovation.</p>
        </div>
      </div>
    </div>
  </section>
@endsection