<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Model 100 Point Roster System</title>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    /* Base Styles */
    body {
      font-family: 'Instrument Sans', Arial, sans-serif;
      margin: 0;
      padding: 0;
      line-height: 1.6;
      background: #f4f7fa;
      color: #333;
      box-sizing: border-box; /* Ensure padding and border are included in the element's total width and height */
    }
    *, *::before, *::after {
      box-sizing: inherit;
    }

    /* Header Section */
    header {
      background: #003366; /* Dark Blue */
      color: #fff;
      padding: 40px 20px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('/placeholder.svg?height=1080&width=1920'); /* Placeholder background image */
      background-size: cover;
      background-position: center;
      opacity: 0.1;
      z-index: 0;
    }
    .header-content {
      position: relative;
      z-index: 1;
      max-width: 900px;
      margin: auto;
      padding: 0 15px; /* Add horizontal padding for smaller screens */
    }
    .header-content h1 {
      font-size: 2.5em;
      margin-bottom: 10px;
      color: #fff;
    }
    .header-content p {
      font-size: 1.1em;
      margin-bottom: 20px;
      color: #e0e0e0;
    }
    .header-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
      flex-wrap: wrap; /* Allow buttons to wrap on smaller screens */
    }
    .header-buttons button {
      padding: 12px 25px;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
      white-space: nowrap; /* Prevent button text from wrapping */
    }
    .header-buttons .primary-btn {
      background: #ff6600; /* Orange */
      color: #fff;
    }
    .header-buttons .primary-btn:hover {
      background: #e65c00;
    }
    .header-buttons .secondary-btn {
      background: transparent;
      color: #fff;
      border: 1px solid #ff6600; /* Orange border */
    }
    .header-buttons .secondary-btn:hover {
      background: #ff6600;
      color: #fff;
    }

    /* Section Styles */
    section {
      padding: 40px 20px;
      max-width: 900px;
      margin: 20px auto; /* Add margin-top and bottom for separation */
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    section:nth-of-type(even) {
      background: #f9f9f9;
    }
    h2 {
      color: #003366; /* Dark Blue */
      font-size: 2em;
      margin-bottom: 20px;
      text-align: center;
    }
    h3 {
      color: #0055aa; /* Medium Blue */
      font-size: 1.4em;
      margin-top: 20px;
      margin-bottom: 10px;
    }
    ul, ol {
      padding-left: 25px;
      margin-bottom: 20px;
    }
    ul li, ol li {
      margin-bottom: 10px;
    }

    /* Grid Layouts for Features, How It Works, Users */
    .feature-grid, .how-it-works-grid, .user-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Adjusted minmax for better responsiveness */
      gap: 20px;
      margin-top: 30px;
    }
    .card {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .card .icon {
      font-size: 2.5em;
      color: #ff6600; /* Orange */
      margin-bottom: 15px;
    }
    .card h3 {
      margin-top: 0;
      color: #003366;
    }
    .card p {
      font-size: 0.9em;
      color: #555;
    }

    /* Highlight Box */
    .highlight {
      background: #e6f0ff; /* Light Blue */
      border-left: 4px solid #003366; /* Dark Blue border */
      padding: 15px 20px;
      margin: 30px 0;
      border-radius: 5px;
    }
    .highlight strong {
      color: #003366;
    }

    /* Why This System Matters & Compliance Section */
    .two-column-layout {
      display: flex;
      flex-wrap: wrap; /* Allow columns to wrap on smaller screens */
      gap: 20px;
    }
    .two-column-layout > div {
      flex: 1;
      min-width: 300px; /* Minimum width before wrapping */
    }

    /* Contact Info Section */
    .contact-info {
      display: flex;
      flex-direction: column; /* Stack vertically by default */
      gap: 15px;
      margin-top: 30px;
      text-align: center;
    }
    .contact-item {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    .contact-item .icon {
      font-size: 1.5em;
      color: #ff6600; /* Orange */
    }
    .contact-item a {
      color: #0055aa;
      text-decoration: none;
    }
    .contact-item a:hover {
      text-decoration: underline;
    }

    /* Footer */
    footer {
      background: #003366; /* Dark Blue */
      color: #e0e0e0;
      text-align: center;
      padding: 20px 0;
      margin-top: 40px;
      font-size: 0.9em;
    }
    footer p {
      margin: 5px 0;
    }
    footer a {
      color: #ff6600;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }

    /* Media Queries for Responsiveness */

    /* Small devices (phones, 600px and down) */
    @media (max-width: 600px) {
      header {
        padding: 30px 15px;
      }
      .header-content h1 {
        font-size: 2em;
      }
      .header-content p {
        font-size: 1em;
      }
      .header-buttons button {
        width: 100%; /* Full width buttons on small screens */
      }
      section {
        padding: 30px 15px;
        margin: 15px auto;
      }
      h2 {
        font-size: 1.8em;
      }
      h3 {
        font-size: 1.2em;
      }
      .feature-grid, .how-it-works-grid, .user-grid {
        grid-template-columns: 1fr; /* Single column layout for cards */
      }
      .two-column-layout > div {
        min-width: unset; /* Remove min-width constraint */
        flex-basis: 100%; /* Each column takes full width */
      }
      .contact-item {
        flex-direction: column; /* Stack icon and text vertically */
        text-align: center;
      }
    }

    /* Medium devices (tablets, 601px to 900px) */
    @media (min-width: 601px) and (max-width: 900px) {
      .header-content h1 {
        font-size: 2.2em;
      }
      .header-content p {
        font-size: 1.05em;
      }
      section {
        padding: 35px 20px;
      }
      h2 {
        font-size: 1.9em;
      }
      .feature-grid, .how-it-works-grid, .user-grid {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Adjust minmax for tablets */
      }
    }

    /* Large devices (desktops, 901px and up) - already handled by base styles and max-width */
  </style>
</head>
<body>
  <header>
    <div class="header-content">
      <h1>Model 100 Point Roster System</h1>
      <p>An intelligent and automated platform designed to streamline and simplify the process of seat reservation and allocation in accordance with the Government of Sikkim’s reservation policies.</p>
      <div class="header-buttons">
        <button class="primary-btn" onclick="window.location.href='/admin/login'">Admin Login</button>
        <button class="secondary-btn" onclick="window.location.href='#contact'">Contact Us</button>
      </div>
    </div>
  </header>

        <section id="about">
        <h2>About the System</h2>
        <p>
            The <strong>Model 100 Point Roster System</strong> is meticulously developed to reflect the reservation framework adopted by the <strong>Government of Sikkim</strong> for recruitment in public services. This system intelligently calculates and allocates roster points based on both vertical and horizontal reservations, ensuring transparency, fairness, and legal compliance.
        </p>

        <h3>Vertical Reservation Categories:</h3>
        <ul>
            <li><strong>Bhutia & Lepcha (BL):</strong> 20%</li>
            <li><strong>OBC – Central List:</strong> 20%</li>
            <li><strong>OBC – State List:</strong> 20%</li>
            <li><strong>Scheduled Tribes (ST):</strong> 13%</li>
            <li><strong>Scheduled Castes (SC):</strong> 6%</li>
            <li><strong>Primitive Tribe:</strong> 5%</li>
            <li><strong>Most Backward Classes – State List (MBC):</strong> 3%</li>
            <li><strong>Weaker Sections of the Society:</strong> 2%</li>
        </ul>

        <h3>Horizontal Reservation Categories:</h3>
        <ul>
            <li><strong>Women:</strong> 33%</li>
            <li><strong>Sports & Artisans:</strong> 5%</li>
            <li><strong>Below Poverty Line (BPL):</strong> 5%</li>
            <li><strong>Ex-Servicemen:</strong> 3%</li>
            <li><strong>Paramilitary & Assam Rifles:</strong> 2%</li>
            <li><strong>PwD – Blind/Low Vision:</strong> 1%</li>
            <li><strong>PwD – Deaf/Hard of Hearing:</strong> 1%</li>
            <li><strong>PwD – Locomotor Disability:</strong> 1%</li>
            <li><strong>PwD – Autism & Others:</strong> 1%</li>
        </ul>

        <p>
            The system automates the distribution of posts across a <strong>100-point cycle</strong>, accurately representing each category based on its designated percentage. It is designed to ensure full compliance with the latest notifications and orders from the Government of Sikkim, thereby eliminating manual errors and promoting equitable opportunity.
        </p>
        </section>


  <section id="features">
    <h2>Key Features</h2>
    <p style="text-align: center;">Our system offers a comprehensive set of features designed to ensure unparalleled accuracy, compliance, and efficiency in roster management.</p>
    <div class="feature-grid">
      <div class="card">
        <span class="icon">✔️</span>
        <h3>Accurate Roster Point Calculation</h3>
        <p>Automated generation of roster positions based on precise category percentages, eliminating manual errors and ensuring mathematical accuracy.</p>
      </div>
      <div class="card">
        <span class="icon">⚖️</span>
        <h3>Government Compliant</h3>
        <p>Developed strictly in line with the official roster policy, notifications, and circulars issued by the Government of Sikkim, ensuring full legal adherence.</p>
      </div>
      <div class="card">
        <span class="icon">👥</span>
        <h3>Vertical & Horizontal Reservation Handling</h3>
        <p>Robust support for complex overlapping categories (e.g., Women in ST, OBC BL, PwD in SC), ensuring correct allocation for all eligible candidates.</p>
      </div>
      <div class="card">
        <span class="icon">💡</span>
        <h3>Dynamic & Scalable</h3>
        <p>Easily adaptable for any cadre or designation size, capable of handling roster cycles beyond 100 points, making it suitable for various departmental needs.</p>
      </div>
      <div class="card">
        <span class="icon">📊</span>
        <h3>Detailed Reports & Exports</h3>
        <p>Generate comprehensive, downloadable reports of category-wise distribution in various formats (e.g., PDF, Excel), facilitating transparency and record-keeping.</p>
      </div>
      <div class="card">
        <span class="icon">🔒</span>
        <h3>User Role Management</h3>
        <p>Secure admin and departmental login with role-based access controls, ensuring data integrity and preventing unauthorized modifications.</p>
      </div>
    </div>
  </section>

  <section id="how-it-works">
    <h2>How It Works</h2>
    <p style="text-align: center;">Our intuitive, step-by-step process makes roster management simple, efficient, and transparent for all users.</p>
    <div class="how-it-works-grid">
      <div class="card">
        <span class="icon">1️⃣</span>
        <h3>Cadre & Designation Setup</h3>
        <p>Admins define specific cadres and designations, assigning sanctioned strength and current vacancies for each, laying the foundation for accurate roster generation.</p>
      </div>
      <div class="card">
        <span class="icon">2️⃣</span>
        <h3>Reservation Categories Setup</h3>
        <p>Users input the precise percentage values for all vertical and horizontal reservation categories as per the latest government policy, ensuring up-to-date compliance.</p>
      </div>
      <div class="card">
        <span class="icon">3️⃣</span>
        <h3>Calculate Seat Allocation</h3>
        <p>With a single click, the system processes the data and generates a detailed seat allocation report, instantly showing the distribution of posts across categories.</p>
      </div>
      <div class="card">
        <span class="icon">4️⃣</span>
        <h3>Export & Share</h3>
        <p>The final roster can be easily downloaded or shared in preferred formats, facilitating official communication and record-keeping across departments.</p>
      </div>
    </div>
  </section>

  <section id="why-it-matters">
    <h2>Why This System Matters & Compliance</h2>
    <div class="two-column-layout">
      <div>
        <h3>Why This System Matters</h3>
        <p>Manual roster preparation is notoriously prone to human errors, inconsistencies, and can lead to disputes and legal challenges. This automated system fundamentally removes ambiguity and ensures that every eligible category receives its fair and rightful representation, thereby upholding the principles of justice and maintaining the integrity and transparency of the entire recruitment and promotion process within public services.</p>
        <p>It reduces administrative burden, saves time, and provides an auditable trail for all allocations, fostering trust and accountability.</p>
      </div>
      <div>
        <h3>Compliance & Policy Adherence</h3>
        <p>This system is meticulously designed and continuously updated in strict adherence to the latest notifications, circulars, and amendments issued by the Department of Personnel, Government of Sikkim, pertaining to:</p>
        <ul>
          <li>The comprehensive 100-point roster cycle and its operational guidelines.</li>
          <li>Precise reservation percentages for all vertical (SC, ST, OBC, MBC, BL, etc.) and horizontal (Women, PwD, Ex-Servicemen, etc.) categories.</li>
          <li>Detailed roster maintenance procedures and reporting requirements for all government departments and public sector undertakings.</li>
          <li>Any other specific directives related to reservation policies and their implementation.</li>
        </ul>
        <p>Our commitment to compliance ensures that your organization remains fully aligned with state regulations, avoiding potential legal complications and promoting equitable employment practices.</p>
      </div>
    </div>
  </section>

  <section id="intended-users">
    <h2>Intended Users</h2>
    <p style="text-align: center;">Our system is specifically built to empower key personnel involved in recruitment, human resources, and administrative management within government bodies.</p>
    <div class="user-grid">
      <div class="card">
        <span class="icon">👨‍💼</span>
        <h3>Government Department Heads</h3>
        <p>For oversight and quick generation of compliant roster reports for their respective departments.</p>
      </div>
      <div class="card">
        <span class="icon">👩‍ HR</span>
        <h3>Human Resource Officers</h3>
        <p>To efficiently manage and implement reservation policies in recruitment and promotion cycles.</p>
      </div>
      <div class="card">
        <span class="icon">⚙️</span>
        <h3>Roster Management Teams</h3>
        <p>Dedicated teams responsible for maintaining and updating roster registers accurately and consistently.</p>
      </div>
      <div class="card">
        <span class="icon">📚</span>
        <h3>Recruitment Cells</h3>
        <p>For ensuring fair and compliant allocation of seats during various recruitment drives.</p>
      </div>
    </div>
  </section>

  <section id="contact">
    <h2>Contact Us</h2>
    <p style="text-align: center;">For any queries, detailed demonstrations, feedback, or technical support regarding the Model 100 Point Roster System, please do not hesitate to reach out to us. Our dedicated team is ready to assist you.</p>
    <div class="contact-info">
      <div class="contact-item">
        <span class="icon">📧</span>
        <div>
          <h3>Email</h3>
          <a href="mailto:support@sk-roster.gov.in">support@sk-roster.gov.in</a>
        </div>
      </div>
      <div class="contact-item">
        <span class="icon">📞</span>
        <div>
          <h3>Helpline</h3>
          <a href="tel:03592-XXXXXX">03592-XXXXXX</a>
        </div>
      </div>
      <div class="contact-item">
        <span class="icon">🏛️</span>
        <div>
          <h3>Address</h3>
          <p>Department of Personnel, Government of Sikkim</p>
        </div>
      </div>
    </div>
    <p style="text-align: center; margin-top: 30px; font-size: 1.1em; color: #0055aa;">
      Let us help you maintain fairness, accuracy, and accountability in your recruitment process.
    </p>
  </section>

  <footer>
    <p>&copy; 2025 Model 100 Point Roster System. All rights reserved.</p>
    <p>Empowering Inclusive Governance.</p>
  </footer>
</body>
</html>
