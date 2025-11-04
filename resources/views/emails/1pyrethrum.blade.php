
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pyrethrum Power Pro | Manna Tech</title>
    
<style>
        :root {
            --primary: #44B900;
            --secondary: #FFAA00;
            --dark: #1a3a1e;
            --light: #f8f9fa;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.7;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 2rem auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px);
        }
        .hero-section {
            position: relative;
            height: 250px;
            overflow: hidden;
        }
        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.9);
        }
        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 100%);
            padding: 2rem;
            color: white;
        }
        .hero-title {
            font-size: 2.2rem;
            margin: 0;
            font-weight: 700;
        }
        .hero-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }
        .content {
            padding: 30px 40px;
        }
        .greeting {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            color: var(--dark);
        }
        .intro-text {
            font-size: 1rem;
            margin-bottom: 2rem;
            color: #555;
        }
        .section-title {
            color: var(--primary);
            border-bottom: 2px solid rgba(68, 185, 0, 0.2);
            padding-bottom: 8px;
            margin: 2rem 0 1.5rem;
            font-size: 1.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        .section-title i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        .specifications ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .specifications ul li {
            background-color: rgba(68, 185, 0, 0.05);
            margin-bottom: 12px;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }
        .specifications ul li:hover {
            transform: translateX(5px);
            background-color: rgba(68, 185, 0, 0.1);
        }
        .specifications strong {
            color: var(--dark);
        }
        .contact-info {
            background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
            padding: 30px;
            text-align: center;
            color: white;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .contact-info p {
            margin: 8px 0;
        }
        .contact-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .contact-title {
            opacity: 0.9;
            margin-bottom: 15px;
        }
        .contact-link {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0 10px;
        }
        .contact-link:hover {
            color: var(--secondary);
            transform: translateY(-2px);
        }
        .btn {
            display: inline-block;
            background-color: var(--secondary);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 170, 0, 0.3);
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 170, 0, 0.4);
            background-color: #ff9900;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero-section">
            <img src="https://i.ibb.co/20mGMPcW/Cover-Photo.png?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&h=300" alt="Pyrethrum Fields" class="hero-image">
            <!-- <div class="hero-overlay">
                <h1 class="hero-title">Pyrethrum Power Pro</h1>
                <p class="hero-subtitle">Sustainable Agriculture Solutions</p>
            </div> -->
        </div>
        
        <div class="content">
            <p class="greeting">Dear {{ $name }},</p>
            <p class="intro-text">I am pleased to introduce Manna Tech Limited, a sustainable agriculture company revitalising Kenya's pyrethrum sector. We are building a modern, integrated value chain - from seed innovation and farmer partnerships to processing of Pyrethrum Refined Extract (PRE) - to deliver reliable, high-quality natural insecticide products for regional and global markets.</p>

            <h2 class="section-title"><i class="fas fa-leaf"></i> Crude Oleoresin Extract (COR)</h2>
            <p>To support production flexibility and market responsiveness, Manna Tech is positioned to be your primary supplier of premium-quality Crude Oleoresin Extract. This allows customers to supplement in-house production while maintaining reliability and quality standards.</p>

            <h2 class="section-title"><i class="fas fa-flask"></i> Pyrethrum Refined Extract (PRE)</h2>
            <p>Our premium-grade Pyrethrum Refined Extract (PRE) meets the highest international standards, making it ideal for high-value applications in agriculture, public health and consumer products. We offer flexible supply agreements to ensure consistent quality and compliance.</p>

            <p>We believe a partnership with your company could significantly enhance the regional pyrethrum value chain, benefiting all stakeholders from farmers to end-users. Let's explore this opportunity together.</p>

            <a href="mailto:wilfred@mannatech.co.ke" class="btn">Schedule a Meeting</a>

            <h2 class="section-title"><i class="fas fa-clipboard-list"></i> Crude Oleoresin Specifications</h2>
            <div class="specifications">
                <ul>
                    <li><strong>Pyrethrin Content W/W minimum:</strong> <span>25%</span></li>
                    <li><strong>Preservative:</strong> BHT added for stability</li>
                    <li><strong>Packaging:</strong> 25kg food-grade drums</li>
                    <li><strong>Price:</strong> Competitive rates based on volume</li>
                    <li><strong>Availability:</strong> Ready for immediate shipment</li>
                </ul>
            </div>

            <h2 class="section-title"><i class="fas fa-star"></i> PRE Specifications</h2>
            <div class="specifications">
                <ul>
                    <li><strong>Total Pyrethrin Content:</strong> ≥ 50% w/w (certified)</li>
                    <li><strong>Packaging:</strong> Customizable (25kg+ drums)</li>
                    <li><strong>Documentation:</strong> Full export compliance</li>
                    <li><strong>Quality Assurance:</strong> Batch testing & CoA</li>
                </ul>
            </div>
        </div>
        <div class="contact-info">
            <p>Ready to discuss your pyrethrum needs?</p>
            <p class="contact-name">Wilfred Davies</p>
            <p class="contact-title">Cofounder - Manna Tech Limited</p>
            <p>
                <a href="tel:+254748480588" class="contact-link"><i class="fas fa-phone"></i> +254 748 480588</a>
                <a href="mailto:wilfred@mannatech.co.ke" class="contact-link"><i class="fas fa-envelope"></i> wilfred@mannatech.co.ke</a>
                <a href="https://mannatech.co.ke/" target="_blank" class="contact-link"><i class="fas fa-globe"></i> mannatech.co.ke</a>
            </p>
</div>
    </div>
</body>
</html>