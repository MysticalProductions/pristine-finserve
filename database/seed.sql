-- ============================================================
-- Pristine Finserve - Comprehensive Seed Data
-- Run after schema.sql: mysql -u root pristine_finserve < database/seed.sql
-- ============================================================

USE `pristine_finserve`;

-- ============================================================
-- SERVICES
-- ============================================================
INSERT INTO `pf_services` (`title`, `slug`, `icon`, `short_desc`, `content`, `features`, `process`, `benefits`, `faq`, `status`, `order`) VALUES
(
  'Financial Consulting',
  'financial-consulting',
  'fas fa-chart-line',
  'Expert financial guidance tailored to your goals. We help individuals and businesses make informed financial decisions.',
  '<p>At Pristine Finserve, our financial consulting services are designed to provide you with comprehensive financial guidance. Whether you are planning for retirement, looking to invest, or need help managing your wealth, our team of experienced consultants is here to help.</p><p>We take a holistic approach to financial planning, considering your current financial situation, future goals, and risk tolerance to create a personalized financial strategy.</p>',
  '["Personalized financial planning","Retirement planning & advisory","Tax optimization strategies","Risk management & insurance planning","Estate planning","Wealth preservation strategies"]',
  '[{"title":"Consultation","description":"Schedule a free initial consultation"},{"title":"Analysis","description":"We analyze your financial situation"},{"title":"Strategy","description":"Custom financial plan developed"},{"title":"Implementation","description":"Execute the financial strategy"},{"title":"Review","description":"Regular portfolio reviews & adjustments"}]',
  '["Expert guidance from Certified Financial Planners","Tailored solutions for your unique needs","Transparent fee structure","Long-term relationship & ongoing support","Access to exclusive investment opportunities","Comprehensive approach covering all aspects"]',
  '[{"question":"What is financial consulting?","answer":"Financial consulting involves professional advice on managing your finances, including investments, taxes, retirement planning, and wealth management."},{"question":"How much does a financial consultation cost?","answer":"Your first consultation is absolutely free. Subsequent services are priced based on the scope of work."},{"question":"How long does the financial planning process take?","answer":"Typically 2-4 weeks depending on the complexity of your financial situation."}]',
  'published', 1
),
(
  'Investment Advisory',
  'investment-advisory',
  'fas fa-hand-holding-usd',
  'Smart investment strategies to grow your wealth. Access curated investment opportunities across multiple asset classes.',
  '<p>Our investment advisory service provides you with expert guidance on building and managing your investment portfolio. We analyze market trends, assess risk, and recommend investments that align with your financial goals.</p><p>From stocks and bonds to mutual funds and real estate, we cover all major asset classes to ensure a well-diversified portfolio.</p>',
  '["Portfolio management & optimization","Mutual fund advisory","Stock market investments","Fixed income investments","Alternative investments","Regular portfolio rebalancing"]',
  '[{"title":"Risk Assessment","description":"Evaluate your risk tolerance"},{"title":"Asset Allocation","description":"Determine optimal asset mix"},{"title":"Investment Selection","description":"Choose suitable investments"},{"title":"Monitoring","description":"Track performance continuously"},{"title":"Rebalancing","description":"Adjust portfolio as needed"}]',
  '["Access to top-performing funds","Regular performance reports","Tax-efficient investment strategies","Diversified portfolio management","Expert market insights","Flexible investment options"]',
  '[{"question":"What is the minimum investment required?","answer":"There is no minimum investment requirement. We work with clients at all levels."},{"question":"How often will my portfolio be reviewed?","answer":"We review portfolios quarterly, with annual comprehensive reviews."},{"question":"Can I track my investments online?","answer":"Yes, you get access to our online portal for real-time portfolio tracking."}]',
  'published', 2
),
(
  'Insurance Assistance',
  'insurance-assistance',
  'fas fa-shield-alt',
  'Comprehensive insurance solutions to protect what matters most. We help you choose the right coverage at the best rates.',
  '<p>Insurance is a crucial part of any financial plan. Our insurance assistance service helps you navigate the complex world of insurance products to find the coverage that best suits your needs and budget.</p><p>We work with all major insurance providers to bring you competitive quotes and comprehensive coverage options.</p>',
  '["Life insurance planning","Health insurance coverage","Motor insurance","Home insurance","Business insurance","Travel insurance"]',
  '[{"title":"Needs Analysis","description":"Assess your insurance needs"},{"title":"Market Comparison","description":"Compare plans from top insurers"},{"title":"Recommendation","description":"Best plan recommendation"},{"title":"Application","description":"Assist with application process"},{"title":"Support","description":"Ongoing claims support"}]',
  '["Compare plans from 50+ insurers","Best rates guaranteed","Hassle-free claims assistance","Expert advice on coverage","Paperless process","Free insurance health check"]',
  '[{"question":"Why use an insurance consultant?","answer":"We help you compare multiple plans, find the best coverage at the lowest price, and assist with claims."},{"question":"Do you help with claims?","answer":"Yes, we provide end-to-end claims assistance to ensure a smooth process."},{"question":"Is there a fee for your service?","answer":"Our service is free. We earn commission from insurance companies, not from you."}]',
  'published', 3
),
(
  'Tax Planning',
  'tax-planning',
  'fas fa-file-invoice-dollar',
  'Strategic tax planning to minimize your tax liability. Stay compliant while maximizing your savings.',
  '<p>Our tax planning services help individuals and businesses optimize their tax position. We stay updated with the latest tax laws and regulations to provide you with effective tax-saving strategies.</p><p>From tax return preparation to strategic tax planning, we handle all aspects of your tax needs.</p>',
  '["Income tax return filing","Tax-saving investment advice","Capital gains planning","Corporate tax planning","GST registration & filing","Tax audit representation"]',
  '[{"title":"Tax Review","description":"Review your tax situation"},{"title":"Strategy","description":"Develop tax-saving plan"},{"title":"Implementation","description":"Execute tax strategies"},{"title":"Filing","description":"Prepare and file returns"},{"title":"Support","description":"Ongoing tax support"}]',
  '["Maximize tax savings legally","Expert guidance from tax professionals","Comprehensive tax planning","Year-round support","Audit assistance","Digital tax filing"]',
  '[{"question":"When should I start tax planning?","answer":"Ideally at the start of the financial year to maximize benefits throughout the year."},{"question":"Do you handle GST filing too?","answer":"Yes, we provide complete GST registration and filing services for businesses."},{"question":"Can you represent me in case of a tax notice?","answer":"Yes, we provide full support in case of any tax notice or audit."}]',
  'published', 4
),
(
  'Wealth Management',
  'wealth-management',
  'fas fa-gem',
  'Comprehensive wealth management for high-net-worth individuals. Preserve and grow your wealth with expert guidance.',
  '<p>Our wealth management service is designed for high-net-worth individuals seeking comprehensive financial management. We provide personalized strategies for wealth preservation, growth, and succession planning.</p><p>From portfolio management to estate planning, we offer a full suite of wealth management services.</p>',
  '["Comprehensive wealth planning","Portfolio management","Estate & succession planning","Philanthropy advisory","Family office services","Alternative investments"]',
  '[{"title":"Discovery","description":"Understand your wealth goals"},{"title":"Planning","description":"Create wealth management plan"},{"title":"Implementation","description":"Execute wealth strategy"},{"title":"Monitoring","description":"Track wealth performance"},{"title":"Reporting","description":"Regular wealth reports"}]',
  '["Dedicated wealth manager","Exclusive investment opportunities","Global investment access","Multi-generational planning","Privacy & confidentiality","Comprehensive wealth reporting"]',
  '[{"question":"What is the minimum portfolio size?","answer":"Our wealth management services are available for portfolios starting at ₹1 Crore."},{"question":"How do you charge for wealth management?","answer":"We charge a percentage of assets under management (AUM), typically 0.5-1.5% annually."},{"question":"Can I access international markets?","answer":"Yes, we provide access to global investment opportunities through our partner network."}]',
  'published', 5
),
(
  'Retirement Planning',
  'retirement-planning',
  'fas fa-umbrella-beach',
  'Plan your dream retirement with confidence. Ensure financial security for your golden years.',
  '<p>Retirement planning is essential for a secure and comfortable future. Our retirement planning service helps you estimate your retirement needs and create a systematic plan to achieve your retirement goals.</p><p>We consider inflation, life expectancy, and your desired lifestyle to create a realistic and achievable retirement plan.</p>',
  '["Retirement corpus calculation","Pension planning","NPS & EPF optimization","Annuity planning","Retirement income strategies","Estate planning"]',
  '[{"title":"Goal Setting","description":"Define retirement goals"},{"title":"Corpus Calculation","description":"Calculate required retirement corpus"},{"title":"Investment Strategy","description":"Create retirement investment plan"},{"title":"Implementation","description":"Set up retirement accounts"},{"title":"Review","description":"Annual retirement plan review"}]',
  '["Systematic retirement planning","Tax-efficient retirement savings","Regular pension income planning","Inflation-adjusted projections","Flexible withdrawal strategies","Expert guidance throughout"]',
  '[{"question":"When should I start retirement planning?","answer":"The earlier the better. Ideally start in your 20s or 30s to maximize compounding benefits."},{"question":"How much do I need for retirement?","answer":"This depends on your lifestyle goals. We help calculate the exact corpus you need."},{"question":"What retirement options are available?","answer":"We evaluate all options including NPS, EPF, mutual funds, annuities, and pension plans."}]',
  'published', 6
);

-- ============================================================
-- LOAN PRODUCTS
-- ============================================================
INSERT INTO `pf_loan_products` (`name`, `slug`, `icon`, `short_desc`, `description`, `min_amount`, `max_amount`, `min_rate`, `max_rate`, `min_tenure_months`, `max_tenure_months`, `processing_fee`, `interest_type`, `eligibility`, `documents`, `features`, `benefits`, `faq`, `status`, `order`) VALUES
(
  'Home Loan',
  'home-loan',
  'fas fa-home',
  'Make your dream home a reality with affordable home loans starting at just 8.40% p.a.',
  '<p>Buying a home is one of the biggest financial decisions you will ever make. At Pristine Finserve, we help you secure the best home loan with competitive interest rates, flexible repayment options, and minimal documentation.</p><p>Whether you are buying a new home, constructing one, or renovating your existing property, we have the right loan product for you.</p>',
  500000, 100000000, 8.40, 10.50, 12, 360, '0.5% of loan amount',
  'reducing',
  '["Indian citizen (resident or NRI)","Age: 21-65 years","Minimum income: ₹25,000/month","Stable employment/business for 2+ years","Good credit score (750+ preferred)","Property must have clear title"]',
  '["Identity proof: Aadhaar, PAN, Passport","Address proof: Utility bill, Passport","Income proof: Salary slips (last 3 months)","Bank statements (last 6 months)","Property documents","IT returns (last 2 years)"]',
  '["Loan up to ₹10 Crore","Interest rates starting 8.40% p.a.","Repayment tenure up to 30 years","Up to 90% financing","Balance transfer facility","Top-up loan available","Dedicated relationship manager"]',
  '["Lowest interest rates guaranteed","Minimal documentation","Quick approval & disbursement","Flexible EMI options","No hidden charges","Pre-approval facility","Step-up/S tep-down EMI options"]',
  '[{"question":"What is the maximum loan amount?","answer":"Up to ₹10 Crore depending on property value and repayment capacity."},{"question":"What is the minimum credit score required?","answer":"A credit score of 750+ is preferred for best rates, but we consider applications with 650+."},{"question":"Can NRIs apply for home loans?","answer":"Yes, we provide home loans to NRIs with proper documentation."},{"question":"How long does disbursal take?","answer":"Typically 7-14 days after document submission."}]',
  'published', 1
),
(
  'Personal Loan',
  'personal-loan',
  'fas fa-user',
  'Instant personal loans up to ₹25 Lakh with minimal documentation and quick disbursal.',
  '<p>Need funds for a wedding, vacation, medical emergency, or any other personal expense? Our personal loans offer quick approval, minimal documentation, and competitive interest rates.</p><p>With flexible repayment options and instant disbursal, we make borrowing simple and hassle-free.</p>',
  25000, 2500000, 10.99, 24.00, 12, 60, '1-2% of loan amount',
  'reducing',
  '["Indian citizen","Age: 21-58 years","Minimum income: ₹20,000/month","Salaried or self-employed","Good credit score (700+)","Minimum 1 year employment"]',
  '["Identity proof: Aadhaar, PAN","Address proof","Income proof: Latest 3 months salary slips","Bank statements (last 3 months)","IT return (last 1 year)","2 passport-size photographs"]',
  '["Loan up to ₹25 Lakh","Instant approval","Minimal documentation","Flexible tenure up to 5 years","No collateral required","Pre-approved offers for existing customers"]',
  '["Quick disbursal within 24 hours","Competitive interest rates","No hidden charges","Flexible repayment options","Minimal paperwork","Dedicated support team"]',
  '[{"question":"How quickly can I get a personal loan?","answer":"Approval within minutes, disbursal within 24 hours for eligible customers."},{"question":"Can I prepay the loan?","answer":"Yes, prepayment is allowed with nominal charges."},{"question":"What is the minimum salary required?","answer":"Minimum monthly income of ₹20,000 is required."}]',
  'published', 2
),
(
  'Business Loan',
  'business-loan',
  'fas fa-briefcase',
  'Fuel your business growth with flexible funding solutions. Loans up to ₹2 Crore for SMEs and startups.',
  '<p>Whether you are looking to expand your business, purchase equipment, or manage working capital, our business loans provide the funding you need to grow. We offer customized loan solutions for businesses of all sizes.</p><p>From small shops to large enterprises, we understand your business needs and provide tailored financing solutions.</p>',
  100000, 20000000, 12.00, 22.00, 12, 84, '1-2.5% of loan amount',
  'reducing',
  '["Business vintage: 2+ years","Annual turnover: ₹5 Lakh+","Age: 21-65 years","Good CIBIL score (700+)","Business should be profitable","KYC documents valid"]',
  '["Business PAN card","Business registration certificate","GST returns (last 1 year)","Bank statements (last 6 months)","IT returns (last 2 years)","Proof of business address"]',
  '["Loan up to ₹2 Crore","Unsecured loans available","Flexible repayment tenure","Working capital & term loans","Equipment financing","Business expansion funding"]',
  '["Quick approval process","Minimal documentation","Flexible repayment options","Competitive interest rates","No collateral for smaller loans","Relationship manager support"]',
  '[{"question":"Can startups apply for business loans?","answer":"Yes, we offer startup funding for businesses with a solid business plan."},{"question":"What is the maximum loan amount?","answer":"Business loans up to ₹2 Crore are available based on business performance."},{"question":"Is collateral required?","answer":"For loans up to ₹25 Lakh, no collateral is required."}]',
  'published', 3
),
(
  'Education Loan',
  'education-loan',
  'fas fa-graduation-cap',
  'Invest in your future with education loans covering tuition, living expenses, and more.',
  '<p>Education is the best investment you can make. Our education loans help students pursue higher education in India and abroad with affordable interest rates and flexible repayment options.</p><p>We cover tuition fees, living expenses, travel costs, and other educational expenses.</p>',
  100000, 50000000, 8.50, 14.00, 12, 180, '0-1% of loan amount',
  'reducing',
  '["Indian citizen","Age: 18-35 years","Admission to recognized institution","Co-applicant with stable income","Good academic record","Course duration: 1-5 years"]',
  '["Admission letter from institution","Fee structure","Academic records","Identity & address proof","Co-applicant income proof","Collateral documents (if applicable)"]',
  '["Loan up to ₹5 Crore (study abroad)","Moratorium period until course completion","No repayment during study period","Cover tuition, living & travel costs","Co-applicant option available","Competitive interest rates"]',
  '["Simple interest during moratorium","Tax benefits under Section 80E","Quick processing & disbursal","Flexible repayment tenure","No prepayment charges","Dedicated education loan counselor"]',
  '[{"question":"Is collateral required for education loans?","answer":"For loans above ₹7.5 Lakh, collateral is typically required."},{"question":"Can I get a loan for studying abroad?","answer":"Yes, we offer loans for studies abroad up to ₹5 Crore."},{"question":"When does repayment start?","answer":"Repayment starts 6-12 months after course completion or 6 months after getting a job, whichever is earlier."}]',
  'published', 4
),
(
  'Vehicle Loan',
  'vehicle-loan',
  'fas fa-car',
  'Drive your dream car with easy auto loans. Quick approval and competitive rates starting 8.25% p.a.',
  '<p>Whether you are buying a new car, a used car, or a two-wheeler, our vehicle loans make it easy and affordable. We offer competitive interest rates, flexible tenure, and quick processing.</p><p>From hatchbacks to luxury SUVs, we finance all types of vehicles.</p>',
  100000, 5000000, 8.25, 14.00, 12, 84, '0.5-1.5% of loan amount',
  'reducing',
  '["Indian citizen","Age: 21-65 years","Minimum income: ₹15,000/month","Valid driving license","Good credit score (700+)","Stable income source"]',
  '["Identity proof: Aadhaar, PAN","Address proof","Income proof (3 months salary slips)","Bank statements (last 3 months)","Car quotation from dealer","Downpayment receipt"]',
  '["Loan up to 100% on-road price","New & used car financing","Interest rates starting 8.25%","Tenure up to 7 years","Quick approval & disbursal","Balance transfer facility"]',
  '["Lowest EMI options","Zero downpayment options","Quick processing","Minimal documentation","No hidden charges","Insurance assistance included"]',
  '[{"question":"What is the maximum loan amount for a car?","answer":"Up to 100% of the on-road price for new cars."},{"question":"Can I get a loan for a used car?","answer":"Yes, we finance used cars up to 5 years old."},{"question":"What is the processing time?","answer":"Usually 2-4 hours for approval and 24-48 hours for disbursal."}]',
  'published', 5
),
(
  'Loan Against Property',
  'loan-against-property',
  'fas fa-building',
  'Unlock the value of your property. Get high-value loans at low interest rates.',
  '<p>Need a large loan amount? Use your property as collateral and get funds at attractive interest rates. Our loan against property offers higher loan amounts, longer tenures, and lower EMIs compared to unsecured loans.</p><p>Ideal for business expansion, education, medical emergencies, or any other major financial need.</p>',
  500000, 100000000, 9.50, 16.00, 12, 240, '0.5-1% of loan amount',
  'reducing',
  '["Property owner with clear title","Age: 21-70 years","Minimum income: ₹30,000/month","Property should be free from legal disputes","Good credit score","Property valuation approved by bank"]',
  '["Property documents & title deed","Approved building plan","Property tax receipts","Identity & address proof","Income proof (6 months)","IT returns (last 3 years)"]',
  '["Loan up to ₹10 Crore","Up to 60% of property value","Interest rates from 9.50% p.a.","Tenure up to 20 years","Balance transfer & top-up","Flexible end-use"]',
  '["Higher loan amount","Lower interest rates","Longer repayment tenure","Lower monthly EMIs","Simple documentation","Quick processing"]',
  '[{"question":"What is the maximum loan-to-value ratio?","answer":"Up to 60% of the property value."},{"question":"What types of property are accepted?","answer":"Residential and commercial properties with clear titles."},{"question":"Can I transfer my existing loan?","answer":"Yes, we offer balance transfer facility with lower interest rates."}]',
  'published', 6
);

-- ============================================================
-- PROMOTER
-- ============================================================
INSERT INTO `pf_team` (`name`, `designation`, `bio`, `photo`, `linkedin`, `order`, `status`) VALUES
('Vikas Giri', 'Founder & Promoter', 'Founder of Pristine Finserve with over 21 years of core banking and lending experience. Previously held leadership roles at Hero FinCorp, Indiabulls Housing Finance and Fullerton India. A passionate advocate of integrity and transparency in financial advisory.', 'team/vikas-giri.jpg', 'https://www.linkedin.com/in/vikas-giri-27a01813/', 1, 'active');

-- ============================================================
-- PARTNERS (Banks & NBFCs)
-- ============================================================
INSERT INTO `pf_partners` (`name`, `slug`, `logo`, `type`, `description`, `website`, `status`, `order`) VALUES
('State Bank of India', 'sbi', 'partners/logo-sbi.svg', 'bank', 'State Bank of India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.sbi.co.in', 'active', 1),
('HDFC Bank', 'hdfc-bank', 'partners/logo-hdfc-bank.svg', 'bank', 'HDFC Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.hdfcbank.com', 'active', 2),
('ICICI Bank', 'icici-bank', 'partners/logo-icici-bank.svg', 'bank', 'ICICI Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.icicibank.com', 'active', 3),
('Axis Bank', 'axis-bank', 'partners/logo-axis-bank.svg', 'bank', 'Axis Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.axisbank.com', 'active', 4),
('Kotak Mahindra Bank', 'kotak-mahindra-bank', 'partners/logo-kotak-mahindra-bank.svg', 'bank', 'Kotak Mahindra Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.kotak.com', 'active', 5),
('Yes Bank', 'yes-bank', 'partners/logo-yes-bank.svg', 'bank', 'Yes Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.yesbank.in', 'active', 6),
('Punjab National Bank', 'punjab-national-bank', 'partners/logo-punjab-national-bank.svg', 'bank', 'Punjab National Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.pnbindia.in', 'active', 7),
('Bank of Baroda', 'bank-of-baroda', 'partners/logo-bank-of-baroda.png', 'bank', 'Bank of Baroda is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.bankofbaroda.in', 'active', 8),
('Bank of India', 'bank-of-india', 'partners/logo-bank-of-india.png', 'bank', 'Bank of India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.bankofindia.co.in', 'active', 9),
('Canara Bank', 'canara-bank', 'partners/logo-canara-bank.svg', 'bank', 'Canara Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.canarabank.com', 'active', 10),
('Union Bank of India', 'union-bank-of-india', 'partners/logo-union-bank-of-india.svg', 'bank', 'Union Bank of India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.unionbankofindia.co.in', 'active', 11),
('Indian Bank', 'indian-bank', 'partners/logo-indian-bank.png', 'bank', 'Indian Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.indianbank.in', 'active', 12),
('Central Bank of India', 'central-bank-of-india', '', 'bank', 'Central Bank of India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.centralbankofindia.co.in', 'active', 13),
('Indian Overseas Bank', 'indian-overseas-bank', 'partners/logo-indian-overseas-bank.svg', 'bank', 'Indian Overseas Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.iob.in', 'active', 14),
('UCO Bank', 'uco-bank', '', 'bank', 'UCO Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.ucobank.com', 'active', 15),
('Bank of Maharashtra', 'bank-of-maharashtra', '', 'bank', 'Bank of Maharashtra is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.bankofmaharashtra.in', 'active', 16),
('Punjab & Sind Bank', 'punjab-sind-bank', 'partners/logo-punjab-sind-bank.svg', 'bank', 'Punjab & Sind Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.psbindia.com', 'active', 17),
('IndusInd Bank', 'indusind-bank', 'partners/logo-indusind-bank.svg', 'bank', 'IndusInd Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.indusind.com', 'active', 18),
('IDFC First Bank', 'idfc-first-bank', 'partners/logo-idfc-first-bank.svg', 'bank', 'IDFC First Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.idfcfirstbank.com', 'active', 19),
('Federal Bank', 'federal-bank', 'partners/logo-federal-bank.svg', 'bank', 'Federal Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.federalbank.co.in', 'active', 20),
('RBL Bank', 'rbl-bank', 'partners/logo-rbl-bank.svg', 'bank', 'RBL Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.rblbank.com', 'active', 21),
('IDBI Bank', 'idbi-bank', 'partners/logo-idbi-bank.svg', 'bank', 'IDBI Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.idbibank.co.in', 'active', 22),
('Bandhan Bank', 'bandhan-bank', 'partners/logo-bandhan-bank.svg', 'bank', 'Bandhan Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.bandhanbank.com', 'active', 23),
('South Indian Bank', 'south-indian-bank', 'partners/logo-south-indian-bank.svg', 'bank', 'South Indian Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.southindianbank.com', 'active', 24),
('Karur Vysya Bank', 'karur-vysya-bank', '', 'bank', 'Karur Vysya Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.kvb.co.in', 'active', 25),
('City Union Bank', 'city-union-bank', 'partners/logo-city-union-bank.png', 'bank', 'City Union Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.cityunionbank.com', 'active', 26),
('CSB Bank', 'csb-bank', 'partners/logo-csb-bank.svg', 'bank', 'CSB Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.csb.co.in', 'active', 27),
('Dhanlaxmi Bank', 'dhanlaxmi-bank', 'partners/logo-dhanlaxmi-bank.png', 'bank', 'Dhanlaxmi Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.dhanbank.com', 'active', 28),
('DCB Bank', 'dcb-bank', 'partners/logo-dcb-bank.svg', 'bank', 'DCB Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.dcbbank.com', 'active', 29),
('Jammu & Kashmir Bank', 'jammu-kashmir-bank', 'partners/logo-jammu-kashmir-bank.svg', 'bank', 'Jammu & Kashmir Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.jkbank.com', 'active', 30),
('Tamilnad Mercantile Bank', 'tamilnad-mercantile-bank', 'partners/logo-tamilnad-mercantile-bank.svg', 'bank', 'Tamilnad Mercantile Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.tmb.in', 'active', 31),
('AU Small Finance Bank', 'au-small-finance-bank', 'partners/logo-au-small-finance-bank.png', 'bank', 'AU Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.aubank.in', 'active', 32),
('Equitas Small Finance Bank', 'equitas-small-finance-bank', 'partners/logo-equitas-small-finance-bank.png', 'bank', 'Equitas Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.equitasbank.com', 'active', 33),
('Ujjivan Small Finance Bank', 'ujjivan-small-finance-bank', '', 'bank', 'Ujjivan Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.ujjivansfb.in', 'active', 34),
('Jana Small Finance Bank', 'jana-small-finance-bank', '', 'bank', 'Jana Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.janabank.com', 'active', 35),
('ESAF Small Finance Bank', 'esaf-small-finance-bank', 'partners/logo-esaf-small-finance-bank.svg', 'bank', 'ESAF Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.esafbank.com', 'active', 36),
('Suryoday Small Finance Bank', 'suryoday-small-finance-bank', '', 'bank', 'Suryoday Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.suryodaybank.com', 'active', 37),
('Utkarsh Small Finance Bank', 'utkarsh-small-finance-bank', '', 'bank', 'Utkarsh Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.utkarsh.bank', 'active', 38),
('North East Small Finance Bank', 'north-east-small-finance-bank', 'partners/logo-north-east-small-finance-bank.png', 'bank', 'North East Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.nesfb.com', 'active', 39),
('Fincare Small Finance Bank', 'fincare-small-finance-bank', '', 'bank', 'Fincare Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.fincarebank.com', 'active', 40),
('Shivalik Small Finance Bank', 'shivalik-small-finance-bank', '', 'bank', 'Shivalik Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.shivalikbank.com', 'active', 41),
('Capital Small Finance Bank', 'capital-small-finance-bank', 'partners/logo-capital-small-finance-bank.png', 'bank', 'Capital Small Finance Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.capitalbank.co.in', 'active', 42),
('Airtel Payments Bank', 'airtel-payments-bank', 'partners/logo-airtel-payments-bank.svg', 'bank', 'Airtel Payments Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.airtel.in/bank', 'active', 43),
('India Post Payments Bank', 'india-post-payments-bank', 'partners/logo-india-post-payments-bank.png', 'bank', 'India Post Payments Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.ippbonline.com', 'active', 44),
('Fino Payments Bank', 'fino-payments-bank', '', 'bank', 'Fino Payments Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.finobank.com', 'active', 45),
('Jio Payments Bank', 'jio-payments-bank', '', 'bank', 'Jio Payments Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.jiopaymentsbank.com', 'active', 46),
('NSDL Payments Bank', 'nsdl-payments-bank', 'partners/logo-nsdl-payments-bank.png', 'bank', 'NSDL Payments Bank is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.nsdlbank.com', 'active', 47),
('HSBC India', 'hsbc-india', 'partners/logo-hsbc-india.svg', 'bank', 'HSBC India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.hsbc.co.in', 'active', 48),
('Standard Chartered India', 'standard-chartered-india', 'partners/logo-standard-chartered-india.png', 'bank', 'Standard Chartered India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.sc.com/in', 'active', 49),
('Citibank India', 'citibank-india', 'partners/logo-citibank-india.svg', 'bank', 'Citibank India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.citibank.co.in', 'active', 50),
('DBS Bank India', 'dbs-bank-india', 'partners/logo-dbs-bank-india.svg', 'bank', 'DBS Bank India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.dbs.com/in', 'active', 51),
('Deutsche Bank India', 'deutsche-bank-india', 'partners/logo-deutsche-bank-india.svg', 'bank', 'Deutsche Bank India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.db.com/india', 'active', 52),
('Barclays India', 'barclays-india', 'partners/logo-barclays-india.svg', 'bank', 'Barclays India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.barclays.in', 'active', 53),
('BNP Paribas India', 'bnp-paribas-india', 'partners/logo-bnp-paribas-india.svg', 'bank', 'BNP Paribas India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.bnpparibas.co.in', 'active', 54),
('MUFG India', 'mufg-india', '', 'bank', 'MUFG India is a leading bank in India offering personal, home, vehicle and business loans, savings accounts and digital banking services.', 'https://www.mufgbank.com/in', 'active', 55),
('Bajaj Finserv', 'bajaj-finserv', 'partners/logo-bajaj-finserv.svg', 'nbfc', 'Bajaj Finserv is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.bajajfinserv.in', 'active', 1),
('Bajaj Finance', 'bajaj-finance', 'partners/logo-bajaj-finance.svg', 'nbfc', 'Bajaj Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.bajajfinserv.in', 'active', 2),
('Tata Capital', 'tata-capital', 'partners/logo-tata-capital.png', 'nbfc', 'Tata Capital is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.tatacapital.com', 'active', 3),
('Aditya Birla Capital', 'aditya-birla-capital', 'partners/logo-aditya-birla-capital.png', 'nbfc', 'Aditya Birla Capital is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.adityabirlacapital.com', 'active', 4),
('Mahindra Finance', 'mahindra-finance', 'partners/logo-mahindra-finance.png', 'nbfc', 'Mahindra Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.mahindrafinance.com', 'active', 5),
('Shriram Finance', 'shriram-finance', 'partners/logo-shriram-finance.png', 'nbfc', 'Shriram Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.shriramfinance.in', 'active', 6),
('Muthoot Finance', 'muthoot-finance', 'partners/logo-muthoot-finance.svg', 'nbfc', 'Muthoot Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.muthootfinance.com', 'active', 7),
('Manappuram Finance', 'manappuram-finance', 'partners/logo-manappuram-finance.png', 'nbfc', 'Manappuram Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.manappuram.com', 'active', 8),
('L&T Finance', 'l-t-finance', 'partners/logo-l-t-finance.png', 'nbfc', 'L&T Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.ltfs.com', 'active', 9),
('Cholamandalam Investment and Finance', 'cholamandalam-investment-finance', 'partners/logo-cholamandalam-investment-finance.png', 'nbfc', 'Cholamandalam Investment and Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.cholamandalam.com', 'active', 10),
('HDB Financial Services', 'hdb-financial-services', '', 'nbfc', 'HDB Financial Services is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.hdbfs.com', 'active', 11),
('Piramal Finance', 'piramal-finance', 'partners/logo-piramal-finance.svg', 'nbfc', 'Piramal Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.piramalfinance.com', 'active', 12),
('LIC Housing Finance', 'lic-housing-finance', 'partners/logo-lic-housing-finance.png', 'nbfc', 'LIC Housing Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.lichousing.com', 'active', 13),
('PNB Housing Finance', 'pnb-housing-finance', '', 'nbfc', 'PNB Housing Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.pnbhousing.com', 'active', 14),
('IndiaBulls Housing Finance', 'indiabulls-housing-finance', '', 'nbfc', 'IndiaBulls Housing Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.indiabullshomeloans.com', 'active', 15),
('Aavas Financiers', 'aavas-financiers', 'partners/logo-aavas-financiers.png', 'nbfc', 'Aavas Financiers is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.aavas.in', 'active', 16),
('Can Fin Homes', 'can-fin-homes', '', 'nbfc', 'Can Fin Homes is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.canfinhomes.com', 'active', 17),
('Repco Home Finance', 'repco-home-finance', '', 'nbfc', 'Repco Home Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.repcohfc.com', 'active', 18),
('Home First Finance', 'home-first-finance', '', 'nbfc', 'Home First Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.homefirstindia.com', 'active', 19),
('GIC Housing Finance', 'gic-housing-finance', 'partners/logo-gic-housing-finance.png', 'nbfc', 'GIC Housing Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.gichfindia.com', 'active', 20),
('Shriram Housing Finance', 'shriram-housing-finance', '', 'nbfc', 'Shriram Housing Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.shriramhousing.in', 'active', 21),
('Hero FinCorp', 'hero-fincorp', 'partners/logo-hero-fincorp.svg', 'nbfc', 'Hero FinCorp is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.herofincorp.com', 'active', 22),
('Poonawalla Fincorp', 'poonawalla-fincorp', 'partners/logo-poonawalla-fincorp.png', 'nbfc', 'Poonawalla Fincorp is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.poonawallafincorp.com', 'active', 23),
('TVS Credit', 'tvs-credit', 'partners/logo-tvs-credit.png', 'nbfc', 'TVS Credit is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.tvscredit.com', 'active', 24),
('IIFL Finance', 'iifl-finance', 'partners/logo-iifl-finance.png', 'nbfc', 'IIFL Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.iifl.com', 'active', 25),
('Edelweiss Financial Services', 'edelweiss-financial-services', '', 'nbfc', 'Edelweiss Financial Services is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.edelweiss.in', 'active', 26),
('JM Financial', 'jm-financial', '', 'nbfc', 'JM Financial is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.jmfl.com', 'active', 27),
('Reliance Capital', 'reliance-capital', '', 'nbfc', 'Reliance Capital is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.reliancecapital.co.in', 'active', 28),
('Sundaram Finance', 'sundaram-finance', '', 'nbfc', 'Sundaram Finance is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.sundaramfinance.in', 'active', 29),
('Fullerton India', 'fullerton-india', '', 'nbfc', 'Fullerton India is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.fullertonindia.com', 'active', 30),
('Kotak Mahindra Prime', 'kotak-prime', '', 'nbfc', 'Kotak Mahindra Prime is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.kotakprime.com', 'active', 31),
('Scripbox', 'scripbox', 'partners/logo-scripbox.png', 'nbfc', 'Scripbox is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://scripbox.com', 'active', 32),
('Zomato Money', 'zomato-money', 'partners/logo-zomato-money.png', 'nbfc', 'Zomato Money is a leading non-banking financial company (NBFC) in India offering loans, credit and investment products.', 'https://www.zomato.com', 'active', 33),
('LIC', 'lic', 'partners/logo-lic.png', 'insurance', 'LIC is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://licindia.in', 'active', 1),
('HDFC Life Insurance', 'hdfc-life-insurance', 'partners/logo-hdfc-life-insurance.svg', 'insurance', 'HDFC Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.hdfclife.com', 'active', 2),
('ICICI Prudential Life Insurance', 'icici-prudential-life', 'partners/logo-icici-prudential-life.png', 'insurance', 'ICICI Prudential Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.iciciprulife.com', 'active', 3),
('SBI Life Insurance', 'sbi-life-insurance', '', 'insurance', 'SBI Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.sbilife.co.in', 'active', 4),
('Max Life Insurance', 'max-life-insurance', '', 'insurance', 'Max Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.maxlifeinsurance.com', 'active', 5),
('Tata AIA Life Insurance', 'tata-aia-life', 'partners/logo-tata-aia-life.png', 'insurance', 'Tata AIA Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.tataaia.com', 'active', 6),
('Bajaj Allianz Life Insurance', 'bajaj-allianz-life', 'partners/logo-bajaj-allianz-life.png', 'insurance', 'Bajaj Allianz Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.bajajallianz.com', 'active', 7),
('Kotak Life Insurance', 'kotak-life-insurance', 'partners/logo-kotak-life-insurance.png', 'insurance', 'Kotak Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.kotaklife.com', 'active', 8),
('Aditya Birla Sun Life Insurance', 'aditya-birla-sun-life', '', 'insurance', 'Aditya Birla Sun Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.adityabirlasunlifeinsurance.com', 'active', 9),
('PNB MetLife', 'pnb-metlife', '', 'insurance', 'PNB MetLife is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.pnbmetlife.com', 'active', 10),
('Reliance Nippon Life Insurance', 'reliance-nippon-life', 'partners/logo-reliance-nippon-life.png', 'insurance', 'Reliance Nippon Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.reliancenipponlife.com', 'active', 11),
('Canara HSBC Life Insurance', 'canara-hsbc-life', 'partners/logo-canara-hsbc-life.svg', 'insurance', 'Canara HSBC Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.canarahsbclife.com', 'active', 12),
('Future Generali Life Insurance', 'future-generali-life', '', 'insurance', 'Future Generali Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.futuregeneralilife.com', 'active', 13),
('Ageas Federal Life Insurance', 'ageas-federal-life', 'partners/logo-ageas-federal-life.svg', 'insurance', 'Ageas Federal Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.ageasfederallife.in', 'active', 14),
('Aegon Life Insurance', 'aegon-life', 'partners/logo-aegon-life.png', 'insurance', 'Aegon Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.aegonlife.com', 'active', 15),
('Edelweiss Tokio Life Insurance', 'edelweiss-tokio-life', '', 'insurance', 'Edelweiss Tokio Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.edelweisstokio.in', 'active', 16),
('Aviva India', 'aviva-india', 'partners/logo-aviva-india.png', 'insurance', 'Aviva India is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.avivaindia.com', 'active', 17),
('IndiaFirst Life Insurance', 'indiafirst-life', '', 'insurance', 'IndiaFirst Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.indiafirstlife.com', 'active', 18),
('Star Union Dai-ichi Life Insurance', 'star-union-dai-ichi', '', 'insurance', 'Star Union Dai-ichi Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.sudlife.in', 'active', 19),
('Shriram Life Insurance', 'shriram-life', 'partners/logo-shriram-life.png', 'insurance', 'Shriram Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.shriramlife.com', 'active', 20),
('Acko Life Insurance', 'acko-life', 'partners/logo-acko-life.png', 'insurance', 'Acko Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.acko.com', 'active', 21),
('Digi Invest Life Insurance', 'digi-invest-life', '', 'insurance', 'Digi Invest Life Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.digiinvest.in', 'active', 22),
('New India Assurance', 'new-india-assurance', 'partners/logo-new-india-assurance.png', 'insurance', 'New India Assurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.newindia.co.in', 'active', 23),
('United India Insurance', 'united-india-insurance', 'partners/logo-united-india-insurance.png', 'insurance', 'United India Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.uiic.co.in', 'active', 24),
('National Insurance Company', 'national-insurance', 'partners/logo-national-insurance.png', 'insurance', 'National Insurance Company is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.nationalinsuranceindia.com', 'active', 25),
('Oriental Insurance', 'oriental-insurance', 'partners/logo-oriental-insurance.svg', 'insurance', 'Oriental Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.orientalinsurance.org.in', 'active', 26),
('ICICI Lombard General Insurance', 'icici-lombard', 'partners/logo-icici-lombard.png', 'insurance', 'ICICI Lombard General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.icicilombard.com', 'active', 27),
('Bajaj Allianz General Insurance', 'bajaj-allianz-general', 'partners/logo-bajaj-allianz-general.png', 'insurance', 'Bajaj Allianz General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.bajajallianz.com', 'active', 28),
('Tata AIG General Insurance', 'tata-aig', 'partners/logo-tata-aig.png', 'insurance', 'Tata AIG General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.tataaig.com', 'active', 29),
('HDFC Ergo General Insurance', 'hdfc-ergo', 'partners/logo-hdfc-ergo.png', 'insurance', 'HDFC Ergo General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.hdfcergo.com', 'active', 30),
('Reliance General Insurance', 'reliance-general', 'partners/logo-reliance-general.png', 'insurance', 'Reliance General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.reliancegeneral.co.in', 'active', 31),
('IFFCO Tokio General Insurance', 'iffco-tokio', 'partners/logo-iffco-tokio.png', 'insurance', 'IFFCO Tokio General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.iffcotokio.co.in', 'active', 32),
('SBI General Insurance', 'sbi-general', '', 'insurance', 'SBI General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.sbigeneral.in', 'active', 33),
('Go Digit General Insurance', 'go-digit', 'partners/logo-go-digit.png', 'insurance', 'Go Digit General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.godigit.com', 'active', 34),
('Acko General Insurance', 'acko-general', 'partners/logo-acko-general.png', 'insurance', 'Acko General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.acko.com', 'active', 35),
('Royal Sundaram General Insurance', 'royal-sundaram', '', 'insurance', 'Royal Sundaram General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.royalsundaram.in', 'active', 36),
('Cholamandalam MS General Insurance', 'cholamandalam-ms', '', 'insurance', 'Cholamandalam MS General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.cholams.murugappa.com', 'active', 37),
('Universal Sompo General Insurance', 'universal-sompo', '', 'insurance', 'Universal Sompo General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.universalsompo.com', 'active', 38),
('Kotak General Insurance', 'kotak-general', 'partners/logo-kotak-general.png', 'insurance', 'Kotak General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.kotakgeneral.com', 'active', 39),
('Future Generali India Insurance', 'future-generali-general', '', 'insurance', 'Future Generali India Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.futuregenerali.in', 'active', 40),
('Liberty General Insurance', 'liberty-general', '', 'insurance', 'Liberty General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.libertyinsurance.in', 'active', 41),
('Raheja QBE General Insurance', 'raheja-qbe', '', 'insurance', 'Raheja QBE General Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.rahejaqbe.com', 'active', 42),
('Star Health and Allied Insurance', 'star-health', 'partners/logo-star-health.png', 'insurance', 'Star Health and Allied Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.starhealth.in', 'active', 43),
('Niva Bupa Health Insurance', 'niva-bupa', 'partners/logo-niva-bupa.png', 'insurance', 'Niva Bupa Health Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.nivabupa.com', 'active', 44),
('Care Health Insurance', 'care-health', '', 'insurance', 'Care Health Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.careinsurance.com', 'active', 45),
('Aditya Birla Health Insurance', 'aditya-birla-health', '', 'insurance', 'Aditya Birla Health Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.adityabirlahealth.com', 'active', 46),
('ManipalCigna Health Insurance', 'manipalcigna', 'partners/logo-manipalcigna.png', 'insurance', 'ManipalCigna Health Insurance is a trusted insurance provider in India offering life, general and health insurance solutions.', 'https://www.manipalcigna.com', 'active', 47),
('CRIF High Mark Credit Bureau', 'crif-high-mark', 'partners/logo-crif-high-mark.png', 'other', 'CRIF High Mark Credit Bureau is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.crifhighmark.com', 'active', 1),
('Experian India', 'experian-india', 'partners/logo-experian-india.svg', 'other', 'Experian India is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.experian.in', 'active', 2),
('Equifax India', 'equifax-india', 'partners/logo-equifax-india.svg', 'other', 'Equifax India is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.equifax.co.in', 'active', 3),
('TransUnion CIBIL', 'transunion-cibil', 'partners/logo-transunion-cibil.png', 'other', 'TransUnion CIBIL is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.cibil.com', 'active', 4),
('NPCI', 'npci', 'partners/logo-npci.svg', 'other', 'NPCI is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.npci.org.in', 'active', 5),
('RBI', 'rbi', 'partners/logo-rbi.svg', 'other', 'RBI is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.rbi.org.in', 'active', 6),
('SEBI', 'sebi', 'partners/logo-sebi.svg', 'other', 'SEBI is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.sebi.gov.in', 'active', 7),
('IRDAI', 'irdai', 'partners/logo-irdai.png', 'other', 'IRDAI is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.irdai.gov.in', 'active', 8),
('PFRDA', 'pfrda', 'partners/logo-pfrda.svg', 'other', 'PFRDA is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.pfrda.org.in', 'active', 9),
('CAMS', 'cams', 'partners/logo-cams.svg', 'other', 'CAMS is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.camsonline.com', 'active', 10),
('KFin Technologies', 'kfin-technologies', '', 'other', 'KFin Technologies is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.kfintech.com', 'active', 11),
('Aadhaar / UIDAI', 'uidai', 'partners/logo-uidai.png', 'other', 'Aadhaar / UIDAI is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://uidai.gov.in', 'active', 12),
('DigiLocker', 'digilocker', 'partners/logo-digilocker.png', 'other', 'DigiLocker is a trusted partner of Pristine Finserve in the financial services ecosystem.', 'https://www.digilocker.gov.in', 'active', 13);


-- ============================================================
-- BLOG CATEGORIES
-- ============================================================
INSERT INTO `pf_blog_categories` (`name`, `slug`, `description`, `color`, `status`) VALUES
('Home Loans', 'home-loans', 'Articles about home loans, property buying tips, and mortgage advice.', '#1B5AAE', 'active'),
('Personal Finance', 'personal-finance', 'Tips and guides on managing personal finances effectively.', '#10B981', 'active'),
('Investment', 'investment', 'Investment strategies, market analysis, and portfolio management tips.', '#D4A843', 'active'),
('Business Loans', 'business-loans', 'Business financing guides, startup funding tips, and SME loans.', '#8B5CF6', 'active'),
('Insurance', 'insurance', 'Insurance guides, comparison tips, and coverage advice.', '#EF4444', 'active'),
('Tax Planning', 'tax-planning', 'Tax saving tips, ITR filing guides, and tax planning strategies.', '#F59E0B', 'active'),
('Financial News', 'financial-news', 'Latest financial news, policy updates, and market trends.', '#6366F1', 'active');

-- ============================================================
-- BLOG POSTS
-- ============================================================
INSERT INTO `pf_blog_posts` (`title`, `slug`, `excerpt`, `content`, `category_id`, `tags`, `status`, `is_featured`, `published_at`) VALUES
(
  'Complete Guide to Home Loans in India 2025',
  'complete-guide-home-loans-india-2025',
  'Everything you need to know about home loans in India. From eligibility to documentation, we cover it all.',
  '<p>Buying a home is a dream for many Indians, and a home loan makes it possible. In this comprehensive guide, we cover everything you need to know about home loans in India.</p><h2>Types of Home Loans</h2><p>There are several types of home loans available: Home Purchase Loans, Home Construction Loans, Home Extension Loans, and Home Improvement Loans.</p><h2>Eligibility Criteria</h2><p>Most banks require you to be 21-65 years old, have a stable income, and a good credit score of 750+.</p><h2>Documents Required</h2><p>You will need identity proof, address proof, income proof, bank statements, and property documents.</p><h2>Interest Rates</h2><p>Home loan interest rates currently range from 8.40% to 10.50% p.a. depending on the lender and your profile.</p>',
  1,
  '["home loan","mortgage","property","interest rates","housing"]',
  'published', 1, '2025-12-15 10:00:00'
),
(
  '10 Smart Investment Strategies for 2025',
  '10-smart-investment-strategies-2025',
  'Discover the top investment strategies to grow your wealth in the current financial landscape.',
  '<p>With the changing economic landscape, it is important to adapt your investment strategy. Here are 10 smart investment strategies for 2025.</p><h2>1. Diversify Your Portfolio</h2><p>Do not put all your eggs in one basket. Spread your investments across different asset classes.</p><h2>2. Focus on Quality Stocks</h2><p>Invest in companies with strong fundamentals, good management, and consistent growth.</p><h2>3. Consider Mutual Funds</h2><p>Mutual funds offer professional management and diversification, making them ideal for retail investors.</p>',
  3,
  '["investment","stocks","mutual funds","portfolio","wealth"]',
  'published', 1, '2025-11-20 10:00:00'
),
(
  'How to Improve Your Credit Score',
  'how-to-improve-credit-score',
  'A good credit score can save you lakhs in interest. Learn how to improve yours.',
  '<p>Your credit score is one of the most important numbers in your financial life. A good credit score can help you get loans at lower interest rates, better credit card offers, and even impact your job prospects.</p><h2>What is a Credit Score?</h2><p>A credit score is a three-digit number that represents your creditworthiness. In India, scores range from 300 to 900, with 900 being the best.</p><h2>Tips to Improve Your Credit Score</h2><p>Pay your bills on time, keep credit utilization below 30%, maintain a mix of credit types, and review your credit report regularly.</p>',
  2,
  '["credit score","CIBIL","credit report","finance","borrowing"]',
  'published', 0, '2025-10-10 10:00:00'
),
(
  'Business Loan vs Personal Loan for Business',
  'business-loan-vs-personal-loan-business',
  'Confused between a business loan and a personal loan for your business? We help you choose.',
  '<p>When you need funds for your business, you have two main options: a business loan or a personal loan used for business purposes. Each has its pros and cons.</p><h2>Business Loans</h2><p>Business loans are specifically designed for business needs. They offer higher amounts, longer tenures, and tax benefits.</p><h2>Personal Loans</h2><p>Personal loans can be used for any purpose, including business. They have faster processing but higher interest rates and lower amounts.</p>',
  4,
  '["business loan","personal loan","SME","startup","funding"]',
  'published', 0, '2025-09-05 10:00:00'
),
(
  'Tax Saving Investments Under Section 80C',
  'tax-saving-investments-section-80c',
  'Explore the best tax saving options under Section 80C of the Income Tax Act.',
  '<p>Section 80C of the Income Tax Act allows deductions of up to ₹1.5 Lakh per financial year. Here are the best investment options to maximize your tax savings.</p><h2>ELSS Mutual Funds</h2><p>Equity Linked Savings Scheme (ELSS) offers tax benefits with potential for high returns. It has a 3-year lock-in period.</p><h2>Public Provident Fund (PPF)</h2><p>PPF offers safe returns with sovereign guarantee. It has a 15-year tenure and current interest rate of 7.1%.</p><h2>National Pension System (NPS)</h2><p>NPS offers additional tax benefits under Section 80CCD(1B) over and above the ₹1.5 Lakh limit.</p>',
  6,
  '["tax saving","80C","ELSS","PPF","NPS","income tax"]',
  'published', 0, '2025-08-15 10:00:00'
),
(
  'Understanding Home Loan Interest Rates',
  'understanding-home-loan-interest-rates',
  'A detailed guide to understanding how home loan interest rates work and how to get the best rate.',
  '<p>Home loan interest rates can be confusing. This guide explains the different types of interest rates and how to get the best deal.</p><h2>Fixed vs Floating Rates</h2><p>Fixed rates remain constant throughout the tenure, while floating rates change with market conditions.</p><h2>How Interest is Calculated</h2><p>Most home loans use a reducing balance method, where interest is calculated on the outstanding principal.</p>',
  1,
  '["home loan","interest rates","fixed","floating","EMI"]',
  'published', 0, '2025-07-20 10:00:00'
),
(
  'Insurance Planning for Young Professionals',
  'insurance-planning-young-professionals',
  'Why young professionals need insurance and how to choose the right coverage.',
  '<p>Insurance is often overlooked by young professionals, but it is a crucial part of financial planning. Here is why you need insurance and how to choose the right coverage.</p><h2>Why Insurance Matters</h2><p>Insurance provides financial protection against unexpected events like accidents, illnesses, or death.</p><h2>Types of Insurance</h2><p>The main types are life insurance, health insurance, and general insurance (motor, home, travel).</p>',
  5,
  '["insurance","life insurance","health insurance","young professionals","financial planning"]',
  'published', 0, '2025-06-10 10:00:00'
),
(
  'EMI Calculator: How to Calculate Your Loan EMI',
  'emi-calculator-how-to-calculate-loan-emi',
  'Learn how to calculate your loan EMI and plan your finances better.',
  '<p>EMI (Equated Monthly Installment) is the fixed amount you pay each month to repay your loan. Our EMI calculator makes it easy to plan your monthly budget.</p><h2>EMI Formula</h2><p>EMI = P × r × (1+r)^n / ((1+r)^n - 1), where P is the principal, r is the monthly interest rate, and n is the number of months.</p><h2>Factors Affecting EMI</h2><p>The EMI depends on the loan amount, interest rate, and tenure. A higher loan amount or interest rate increases the EMI, while a longer tenure reduces it.</p>',
  2,
  '["EMI","calculator","loan","finance","budget"]',
  'published', 0, '2025-05-01 10:00:00'
),
(
  'Complete Guide to Personal Loans in India: Rates, Eligibility & Smart Borrowing',
  'complete-guide-personal-loans-india',
  'Planning to take a personal loan? This comprehensive guide covers eligibility, interest rates, EMI calculation, documentation, and common mistakes to avoid in India.',
  '<p>Planning to take a personal loan in India? You are not alone. Personal loans have become one of the most popular ways to fund weddings, travel, medical emergencies, home renovation, and even business needs. Because they are unsecured, they offer quick disbursal and minimal paperwork — but they also come with higher interest rates and strict eligibility checks. This comprehensive guide covers everything you need to know about personal loans in India, from eligibility and interest rates to documentation, repayment strategies, and common mistakes to avoid.</p>

<h2>What Is a Personal Loan?</h2>
<p>A personal loan is an unsecured loan provided by banks, NBFCs, and online lenders to meet any personal financial need. Unlike home loans or car loans, you do not need to pledge any collateral or asset. The lender decides your eligibility based on your credit profile, income, employment stability, and repayment capacity.</p>
<p>Because there is no collateral, lenders carry higher risk, which is why personal loan interest rates are generally higher than secured loans. The trade-off is speed — many lenders disburse personal loans within 24 to 72 hours of approval.</p>

<h2>Types of Personal Loans</h2>
<p>Personal loans are not one-size-fits-all. Depending on your requirement, you can choose from several variants:</p>
<h3>1. Standard Personal Loan</h3>
<p>The most common type, used for any purpose — wedding, travel, medical expenses, or debt consolidation. Loan amounts typically range from ₹50,000 to ₹40 lakh, with tenures of 1 to 6 years.</p>
<h3>2. Medical Emergency Loan</h3>
<p>Specialised loans designed for hospitalisation and medical treatment costs. Some lenders offer instant approval and lower documentation for medical emergencies.</p>
<h3>3. Wedding Loan</h3>
<p>Banks and NBFCs offer dedicated wedding loans with flexible tenures to cover venue, catering, jewellery, and other marriage expenses.</p>
<h3>4. Travel Loan</h3>
<p>Designed for planned holidays and international trips, these loans cover airfare, hotel bookings, and travel insurance.</p>
<h3>5. Education Loan (Non-Collateralised)</h3>
<p>Though education loans are usually secured by a parent\'s collateral, some lenders offer unsecured loans for skill development courses, professional certifications, and short-term study programmes.</p>
<h3>6. Top-Up Personal Loan</h3>
<p>Available to existing customers who already have a loan, a top-up loan adds extra funds on top of the outstanding amount, often at a lower rate than a fresh personal loan.</p>

<h2>Personal Loan Eligibility Criteria</h2>
<p>Eligibility rules vary by lender, but most financial institutions consider the following parameters:</p>
<ul>
  <li><strong>Age:</strong> Typically 21 to 58 years for salaried applicants and up to 65 years for self-employed professionals.</li>
  <li><strong>Income:</strong> Minimum monthly income of ₹20,000 to ₹25,000 for salaried individuals, depending on the city and lender.</li>
  <li><strong>Employment:</strong> At least 1 year of total work experience and 3 to 6 months in the current organisation for salaried applicants. Self-employed applicants need 2+ years of business continuity.</li>
  <li><strong>Credit Score:</strong> A CIBIL score of 700 or above dramatically improves your approval chances and gets you better interest rates.</li>
  <li><strong>Debt-to-Income Ratio:</strong> Lenders prefer that your total monthly EMIs do not exceed 40% to 50% of your net income.</li>
  <li><strong>Existing relationships:</strong> Salary account holders and existing customers often receive pre-approved offers with relaxed criteria.</li>
</ul>

<h2>Personal Loan Interest Rates in India</h2>
<p>Interest rates for personal loans in India generally range from 10.50% p.a. to 24% p.a., depending on the lender, your credit profile, income, and loan amount.</p>
<table style="width:100%;border-collapse:collapse;margin:1rem 0;">
  <thead>
    <tr>
      <th style="border:1px solid #ddd;padding:10px;text-align:left;background:#f5f5f5;">Lender Type</th>
      <th style="border:1px solid #ddd;padding:10px;text-align:left;background:#f5f5f5;">Interest Rate Range</th>
      <th style="border:1px solid #ddd;padding:10px;text-align:left;background:#f5f5f5;">Processing Fee</th>
    </tr>
  </thead>
  <tbody>
    <tr><td style="border:1px solid #ddd;padding:10px;">Public Sector Banks</td><td style="border:1px solid #ddd;padding:10px;">10.50% – 15.00% p.a.</td><td style="border:1px solid #ddd;padding:10px;">0.50% – 1.00%</td></tr>
    <tr><td style="border:1px solid #ddd;padding:10px;">Private Sector Banks</td><td style="border:1px solid #ddd;padding:10px;">10.75% – 18.00% p.a.</td><td style="border:1px solid #ddd;padding:10px;">0.75% – 2.00%</td></tr>
    <tr><td style="border:1px solid #ddd;padding:10px;">NBFCs</td><td style="border:1px solid #ddd;padding:10px;">11.00% – 21.00% p.a.</td><td style="border:1px solid #ddd;padding:10px;">1.00% – 2.50%</td></tr>
    <tr><td style="border:1px solid #ddd;padding:10px;">Online / Fintech Lenders</td><td style="border:1px solid #ddd;padding:10px;">12.00% – 24.00% p.a.</td><td style="border:1px solid #ddd;padding:10px;">1.50% – 3.00%</td></tr>
  </tbody>
</table>
<p>Note that the effective cost of a personal loan also includes processing fees, GST on those fees, and prepayment charges. Always compare the annualised cost before choosing a lender.</p>

<h2>Documents Required for a Personal Loan</h2>
<p>Personal loans require minimal documentation compared to secured loans. The typical checklist includes:</p>
<h3>For Salaried Applicants</h3>
<ul>
  <li>Identity proof: PAN card, Aadhaar card, passport, or driving licence</li>
  <li>Address proof: Utility bill, Aadhaar, or rental agreement</li>
  <li>Latest 2 to 3 salary slips</li>
  <li>Last 3 to 6 months of bank statements</li>
  <li>Form 16 or latest income tax returns</li>
</ul>
<h3>For Self-Employed Applicants</h3>
<ul>
  <li>Identity and address proofs as above</li>
  <li>Business registration / incorporation certificate</li>
  <li>Last 2 years of income tax returns</li>
  <li>Certified financial statements and profit &amp; loss account</li>
  <li>Last 6 months of business and personal bank statements</li>
</ul>

<h2>How to Calculate Your Personal Loan EMI</h2>
<p>Your EMI (Equated Monthly Instalment) depends on three factors: the loan amount (P), the monthly interest rate (r = annual rate / 12), and the tenure in months (n). The standard formula is:</p>
<p><strong>EMI = P × r × (1 + r)^n / [(1 + r)^n – 1]</strong></p>
<p>For example, a loan of ₹5,00,000 at 12% p.a. for 3 years would result in an EMI of approximately ₹16,607. Over the full tenure you would repay roughly ₹5,97,852, of which ₹97,852 is interest. A longer tenure lowers the EMI but increases the total interest paid, while a shorter tenure does the opposite.</p>
<p>Use the EMI calculator on this website to check your exact monthly outflow before applying.</p>

<h2>Factors That Affect Your Personal Loan Approval</h2>
<p>Lenders evaluate several factors when you apply. Here is what matters most:</p>
<h3>1. Credit Score (CIBIL)</h3>
<p>Your CIBIL score is the single biggest factor. A score above 750 is considered excellent. Scores below 650 face higher rejection rates, and if approved, attract higher interest rates.</p>
<h3>2. Income Stability</h3>
<p>A stable income with regular increments signals lower default risk. Lenders favour applicants who have been with the same employer for at least 6 months.</p>
<h3>3. Debt-to-Income Ratio</h3>
<p>If a large chunk of your income already goes towards existing EMIs, lenders may reject your application or sanction a smaller amount.</p>
<h3>4. Employment Type</h3>
<p>Government employees and professionals in high-income sectors often get preferential rates. Self-employed applicants need consistent business income records.</p>
<h3>5. Loan Amount and Tenure</h3>
<p>Smaller loans with shorter tenures are easier to approve. Your request should align with your repayment capacity.</p>

<h2>How to Get the Lowest Personal Loan Interest Rate</h2>
<p>Interest rates are not fixed — they are negotiated. Follow these steps to improve your chances of a lower rate:</p>
<ul>
  <li><strong>Improve your credit score:</strong> Clear dues, reduce credit utilisation below 30%, and avoid multiple loan applications in a short period.</li>
  <li><strong>Compare offers:</strong> Check rates across at least 4 to 5 banks and NBFCs before deciding.</li>
  <li><strong>Apply with your salary bank:</strong> Your existing bank has your transaction history and may offer lower rates.</li>
  <li><strong>Add a co-applicant:</strong> A co-applicant with a strong income and credit profile improves the combined repayment capacity.</li>
  <li><strong>Choose a shorter tenure:</strong> Lenders reward lower risk with lower rates.</li>
  <li><strong>Use pre-approved offers:</strong> Banks often email pre-approved personal loan offers at discounted rates to existing customers.</li>
</ul>

<h2>Common Mistakes to Avoid</h2>
<p>Many borrowers end up paying more than necessary because of avoidable errors:</p>
<ul>
  <li><strong>Applying to multiple lenders at once:</strong> Every application triggers a hard inquiry on your credit report, which can lower your score.</li>
  <li><strong>Ignoring the processing fee:</strong> A "lower" rate can be costlier once you factor in a high processing fee.</li>
  <li><strong>Borrowing more than you need:</strong> Larger loans mean higher EMIs and more interest over time.</li>
  <li><strong>Choosing the longest tenure by default:</strong> Stretching tenure to shrink EMIs dramatically increases total interest.</li>
  <li><strong>Missing EMI payments:</strong> A single default can drop your credit score by 50 to 100 points and attract penalties.</li>
  <li><strong>Not reading the fine print:</strong> Hidden charges such as documentation fees, penalty rates, and foreclosure charges can surprise you later.</li>
</ul>

<h2>Personal Loan vs Other Loan Options</h2>
<p>Before choosing a personal loan, compare it with alternatives:</p>
<h3>Personal Loan vs Loan Against Property</h3>
<p>Loan against property offers lower interest rates (8.75% – 10.50% p.a.) and larger amounts because your property is used as collateral. However, approval takes longer and you risk losing the property in case of default.</p>
<h3>Personal Loan vs Credit Card Loan</h3>
<p>Credit card loans are convenient but carry the highest interest rates (24% – 42% p.a.). A personal loan is almost always cheaper for large amounts.</p>
<h3>Personal Loan vs Gold Loan</h3>
<p>Gold loans are secured and cheap (7.5% – 12% p.a.), but you must pledge your gold. If you have gold lying idle, it may be a better option.</p>

<h2>Prepayment and Foreclosure Rules</h2>
<p>Most lenders allow you to close a personal loan early, but rules vary:</p>
<ul>
  <li>Many banks charge a foreclosure fee of 1% to 4% of the outstanding principal on fixed-rate personal loans.</li>
  <li>Some NBFCs and fintech lenders charge 0% foreclosure fee after a certain number of EMIs.</li>
  <li>Prepayment before 12 months may attract additional charges with certain lenders.</li>
  <li>Always ask for a foreclosure statement that includes the exact payoff amount and any applicable fees.</li>
</ul>
<p>If you have surplus funds and no higher-yielding investment, prepaying a high-interest personal loan is usually a smart financial move.</p>

<h2>How Pristine Finserve Can Help</h2>
<p>At Pristine Finserve, we compare personal loan offers from 30+ banks and NBFCs to find the best rate for your profile. Our team handles eligibility checks, documentation, and disbursal coordination end to end, so you can focus on what matters. With over 10,000 happy customers and loans worth ₹500+ crores facilitated, we bring transparency and speed to every loan journey.</p>

<h2>Frequently Asked Questions</h2>
<h3>1. Can I get a personal loan without a CIBIL score?</h3>
<p>Yes, some lenders and fintech platforms use alternative data such as your bank statement cash flows, but the interest rate will be higher and the approved amount smaller.</p>
<h3>2. How quickly can I get a personal loan?</h3>
<p>Most lenders approve within minutes and disburse within 24 to 72 hours. Some fintech apps disburse the same day.</p>
<h3>3. Can I use a personal loan to consolidate my debts?</h3>
<p>Yes, debt consolidation is a popular use case. Taking one personal loan to repay multiple high-interest debts simplifies payments and can reduce your total interest outflow.</p>
<h3>4. Is a personal loan taxable?</h3>
<p>No, a personal loan is not taxable income. However, interest paid on personal loans is not tax-deductible unless the loan is used for business purposes.</p>
<h3>5. What happens if I miss an EMI?</h3>
<p>You will be charged a penalty, typically 1% to 2% of the overdue amount, and your credit score will be affected. Multiple missed payments can lead to legal action and asset attachment in case of secured loans.</p>
<h3>6. Can I transfer my personal loan to another bank?</h3>
<p>Yes, some banks allow balance transfer of personal loans, though the benefit is smaller than for home loans. Compare the interest savings against the transfer fee before switching.</p>

<p><strong>Final Word:</strong> A personal loan can be a powerful tool when used responsibly. Compare offers, check the total cost, and never borrow more than you can comfortably repay. If you need help choosing the right lender, reach out to Pristine Finserve — our experts are one call away.</p>
',
  2,
  '["personal loan","interest rates","EMI","borrowing","credit score"]',
  'published', 1, '2026-08-16 10:00:00'
);

-- ============================================================
-- CALCULATORS
-- ============================================================
INSERT INTO `pf_calculators` (`title`, `slug`, `type`, `description`, `default_rate`, `default_tenure`, `default_amount`, `status`, `order`) VALUES
('EMI Calculator', 'emi', 'emi', 'Calculate your monthly EMI for any loan amount, interest rate, and tenure.', 10.50, 60, 1000000, 'active', 1),
('Home Loan EMI Calculator', 'home-loan-emi', 'emi', 'Calculate monthly EMI for your home loan.', 8.50, 240, 5000000, 'active', 2),
('Personal Loan EMI Calculator', 'personal-loan-emi', 'emi', 'Plan your personal loan repayment with our easy EMI calculator.', 12.00, 36, 500000, 'active', 3),
('Car Loan EMI Calculator', 'car-loan-emi', 'emi', 'Calculate your car loan EMI and plan your budget.', 9.00, 60, 800000, 'active', 4),
('Loan Affordability/Eligibility Calculator', 'eligibility', 'eligibility', 'Check your loan eligibility based on your income and existing obligations.', 10.50, 60, 0, 'active', 5),
('Home Loan Eligibility Calculator', 'home-loan-eligibility', 'eligibility', 'Find out how much home loan you are eligible for.', 8.50, 240, 0, 'active', 6),
('EMI vs SIP Calculator', 'emi-vs-sip', 'comparison', 'Compare the benefits of paying off your loan vs investing in SIPs.', 10.50, 60, 1000000, 'active', 8),
('SIP Calculator', 'sip', 'sip', 'Calculate the future value of your systematic investment plan.', 12.00, 120, 5000, 'active', 10),
('Lumpsum Calculator', 'lumpsum', 'lump-sum', 'Calculate the future value of a one-time lumpsum investment.', 12.00, 60, 100000, 'active', 11);

-- ============================================================
-- TESTIMONIALS (Additional)
-- ============================================================
INSERT INTO `pf_testimonials` (`client_name`, `client_company`, `client_designation`, `content`, `rating`, `loan_type`, `amount_sanctioned`, `status`, `is_featured`, `order`) VALUES
('Suresh Reddy', 'Reddy Constructions', 'Managing Director', 'Outstanding service! Pristine Finserve helped me secure a business loan at the best possible rate. Their team was professional and responsive throughout.', 5, 'Business Loan', 7500000.00, 'published', 1, 1),
('Lata Krishnan', 'Krishnan Jewelers', 'Owner', 'I was amazed at how smooth the home loan process was. From application to disbursement, everything was handled efficiently. Highly recommend their services.', 5, 'Home Loan', 4200000.00, 'published', 1, 2),
('Deepak Joshi', NULL, 'Software Engineer', 'Got a personal loan for my wedding within 24 hours! The interest rate was competitive and the team made the entire process hassle-free.', 5, 'Personal Loan', 350000.00, 'published', 1, 3),
('Meera Iyer', 'Iyer Consultancy', 'Consultant', 'The best financial advisory team I have worked with. They helped me plan my retirement and optimized my investment portfolio. Truly expert guidance.', 5, 'Retirement Planning', 0.00, 'published', 1, 4),
('Rahul Sharma', NULL, 'Doctor', 'Vehicle loan approved in just 2 hours! The team at Pristine Finserve goes above and beyond to help their clients. Thank you for the wonderful service.', 5, 'Vehicle Loan', 1200000.00, 'published', 1, 5),
('Anjali Desai', 'Desai Properties', 'Real Estate Developer', 'Their loan against property service helped me unlock capital for my new project. The valuation was fair and the interest rate was the best in the market.', 5, 'Loan Against Property', 8500000.00, 'published', 1, 6);

-- ============================================================
-- STATISTICS
-- ============================================================
INSERT INTO `pf_statistics` (`label`, `value`, `suffix`, `icon`, `order`, `status`) VALUES
('Loans Disbursed', '5000', '+', 'fas fa-hand-holding-usd', 1, 'active'),
('Happy Customers', '10000', '+', 'fas fa-smile', 2, 'active'),
('Years Experience', '15', '+', 'fas fa-calendar-alt', 3, 'active'),
('Bank Partners', '50', '+', 'fas fa-university', 4, 'active'),
('Cities Covered', '100', '+', 'fas fa-city', 5, 'active'),
('Loan Sanctioned', '500', 'Cr+', 'fas fa-rupee-sign', 6, 'active'),
('Approval Rate', '98', '%', 'fas fa-check-circle', 7, 'active'),
('Team Members', '200', '+', 'fas fa-users', 8, 'active');

-- ============================================================
-- FAQS (General)
-- ============================================================
INSERT INTO `pf_faqs` (`question`, `answer`, `category`, `order`, `status`) VALUES
('What documents are required for a loan application?', 'Typically you need identity proof (Aadhaar, PAN), address proof, income proof (salary slips, IT returns), bank statements, and property documents (for secured loans).', 'Loans', 1, 'active'),
('How long does loan approval take?', 'Approval times vary by loan type. Personal loans can be approved within minutes, while home loans may take 7-14 days for complete processing.', 'Loans', 2, 'active'),
('What is CIBIL score and why does it matter?', 'CIBIL score is a 3-digit number (300-900) that represents your creditworthiness. A higher score increases your chances of loan approval and better interest rates.', 'Loans', 3, 'active'),
('Can I get a loan with a low credit score?', 'Yes, some lenders offer loans to individuals with lower credit scores, but the interest rates may be higher. We can help find the best option for your situation.', 'Loans', 4, 'active'),
('What is the difference between fixed and floating interest rates?', 'Fixed rates remain constant throughout the loan tenure, while floating rates change with market conditions. Floating rates are generally lower initially.', 'Loans', 5, 'active'),
('Do you charge for consultation?', 'Your first consultation is completely free. We believe in providing value before asking for any commitment.', 'General', 6, 'active'),
('How do I start the loan application process?', 'Simply fill out the inquiry form on our website or call us. One of our relationship managers will contact you within 24 hours.', 'General', 7, 'active'),
('What areas do you serve?', 'We serve clients across 100+ cities in India. Our network of branches and partner offices ensures we are accessible wherever you are.', 'General', 8, 'active');

-- ============================================================
-- BRANCHES / OFFICES
-- ============================================================
INSERT INTO `pf_branches` (`name`, `address`, `city`, `state`, `pincode`, `phone`, `email`, `is_head_office`, `order`, `status`) VALUES
('Head Office - Mumbai', '501, Business Hub, Opp. Andheri Station, Andheri West, Mumbai', 'Mumbai', 'Maharashtra', '400053', '+91 22 4567 8901', 'mumbai@pristinefinserve.com', 1, 1, 'active'),
('Delhi Office', 'Plot 45, Connaught Place, Near Metro Station, New Delhi', 'New Delhi', 'Delhi', '110001', '+91 11 2345 6789', 'delhi@pristinefinserve.com', 0, 2, 'active'),
('Bangalore Office', '201, Tech Park, MG Road, Indiranagar, Bangalore', 'Bangalore', 'Karnataka', '560038', '+91 80 4567 8901', 'bangalore@pristinefinserve.com', 0, 3, 'active'),
('Pune Office', 'Office 12, ICC Tower, Senapati Bapat Road, Pune', 'Pune', 'Maharashtra', '411016', '+91 20 4567 8901', 'pune@pristinefinserve.com', 0, 4, 'active'),
('Ahmedabad Office', '305, Super Mall, CG Road, Ahmedabad', 'Ahmedabad', 'Gujarat', '380009', '+91 79 4567 8901', 'ahmedabad@pristinefinserve.com', 0, 5, 'active'),
('Chennai Office', '1st Floor, Marina Towers, Mount Road, Chennai', 'Chennai', 'Tamil Nadu', '600002', '+91 44 4567 8901', 'chennai@pristinefinserve.com', 0, 6, 'active'),
('Kolkata Office', 'Salt Lake City, Sector V, Kolkata', 'Kolkata', 'West Bengal', '700091', '+91 33 4567 8901', 'kolkata@pristinefinserve.com', 0, 7, 'active'),
('Hyderabad Office', 'Hitech City, Madhapur, Hyderabad', 'Hyderabad', 'Telangana', '500081', '+91 40 4567 8901', 'hyderabad@pristinefinserve.com', 0, 8, 'active');

-- ============================================================
-- MILESTONES
-- ============================================================
INSERT INTO `pf_milestones` (`title`, `description`, `icon`, `year`, `order`, `status`) VALUES
('Company Founded', 'Pristine Finserve established with a vision to transform financial consulting in India.', 'fas fa-rocket', '2010', 1, 'active'),
('First 1000 Customers', 'Achieved the milestone of serving 1000 happy customers across Mumbai.', 'fas fa-users', '2012', 2, 'active'),
('Pan-India Expansion', 'Expanded operations to 10 cities across India.', 'fas fa-map-marked-alt', '2014', 3, 'active'),
('50 Bank Partnerships', 'Partnered with 50+ banks and NBFCs to offer best-in-class rates.', 'fas fa-handshake', '2016', 4, 'active'),
('Digital Transformation', 'Launched online platform for loan applications and financial planning.', 'fas fa-laptop', '2018', 5, 'active'),
('₹500 Crore Loans Disbursed', 'Crossed the milestone of ₹500 Crore in total loans disbursed.', 'fas fa-rupee-sign', '2020', 6, 'active'),
('100 Cities Covered', 'Expanded presence to 100+ cities across India.', 'fas fa-city', '2022', 7, 'active'),
('10000+ Happy Customers', 'Served over 10,000 satisfied customers nationwide.', 'fas fa-smile', '2024', 8, 'active');

-- ============================================================
-- ACHIEVEMENTS
-- ============================================================
INSERT INTO `pf_achievements` (`title`, `description`, `year`, `order`, `status`) VALUES
('Best Financial Advisory Firm', 'Awarded by Financial Express for excellence in financial advisory services.', '2019', 1, 'active'),
('Top Loan Consultancy of the Year', 'Recognized at the India Banking & Finance Summit for outstanding loan consultancy.', '2020', 2, 'active'),
('Excellence in Customer Service', 'Awarded by Times of India for exceptional customer service standards.', '2021', 3, 'active'),
('Fastest Growing Fintech', 'Featured in Deloitte Fast 50 as one of Indias fastest growing financial service companies.', '2022', 4, 'active'),
('Innovation in Financial Services', 'Recognized at the National Financial Innovation Awards for digital transformation in lending.', '2023', 5, 'active'),
('Great Place to Work Certified', 'Certified as a Great Place to Work for two consecutive years.', '2024', 6, 'active');

-- ============================================================
-- VALUES
-- ============================================================
INSERT INTO `pf_values` (`title`, `description`, `icon`, `order`, `status`) VALUES
('Trust & Transparency', 'We believe in building lasting relationships through honest and transparent dealings with our clients.', 'fas fa-handshake', 1, 'active'),
('Customer First', 'Every decision we make is centered around our clients best interests and financial well-being.', 'fas fa-heart', 2, 'active'),
('Excellence', 'We strive for excellence in everything we do, from service delivery to client satisfaction.', 'fas fa-star', 3, 'active'),
('Innovation', 'We continuously innovate to provide cutting-edge financial solutions and digital experiences.', 'fas fa-lightbulb', 4, 'active'),
('Integrity', 'We uphold the highest ethical standards in all our business practices.', 'fas fa-shield-alt', 5, 'active'),
('Inclusivity', 'We believe in making financial services accessible to everyone, regardless of their background.', 'fas fa-globe-asia', 6, 'active');

-- ============================================================
-- GALLERY
-- ============================================================
INSERT INTO `pf_gallery` (`title`, `description`, `type`, `category`, `status`, `is_featured`, `order`) VALUES
('Annual Awards Night 2024', 'Pristine Finserve team celebrating at the annual awards ceremony.', 'event', 'Events', 'active', 1, 1),
('Financial Literacy Workshop', 'Conducted a financial literacy workshop for young professionals in Mumbai.', 'event', 'Events', 'active', 1, 2),
('New Office Inauguration', 'Inauguration of our new corporate office in Bangalore.', 'event', 'Events', 'active', 0, 3),
('Team Building Activity', 'Annual team building event at Lonavala with the entire Pristine Finserve team.', 'event', 'Events', 'active', 0, 4),
('Community Outreach Program', 'Our team volunteering at a local school for financial education.', 'event', 'Events', 'active', 1, 5),
('Client Meet & Greet', 'Annual client appreciation event held at Taj Mahal Palace, Mumbai.', 'event', 'Events', 'active', 0, 6),
('Diwali Celebration 2024', 'Diwali celebration at our headquarters with全体员工 and families.', 'event', 'Events', 'active', 0, 7),
('Award Ceremony', 'Receiving the Best Financial Advisory Firm award for the third consecutive year.', 'event', 'Events', 'active', 0, 8);

-- ============================================================
-- PAGES (Additional)
-- ============================================================
INSERT INTO `pf_pages` (`title`, `slug`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `template`, `status`, `show_in_menu`) VALUES
('Privacy Policy', 'privacy-policy', '<h2>1. Introduction</h2>
<p>Pristine Finserve (\"we\", \"our\", \"us\", or \"the Company\") respects your privacy and is committed to protecting the personal information you share with us. This Privacy Policy explains what information we collect, why we collect it, how we use and protect it, and the choices you have regarding your data when you visit our website (the \"Site\") or use our loan consultancy, financial advisory, and related services.</p>
<p>By accessing or using our website or services, you consent to the collection, use, and disclosure of your information in accordance with this Privacy Policy. Please read this document carefully. If you do not agree with any part of this policy, you should stop using our website and services.</p>

<h2>2. Information We Collect</h2>
<p>We collect information in two ways: information you provide directly to us, and information we collect automatically when you use our website.</p>
<h3>2.1 Information You Provide Directly</h3>
<ul>
  <li><strong>Personal identification information:</strong> your name, date of birth, gender, and photograph.</li>
  <li><strong>Contact details:</strong> email address, phone number, WhatsApp number, and residential or office address.</li>
  <li><strong>Financial information:</strong> income details, employment details, bank account information, credit score details, and loan-related documents you voluntarily share for loan processing.</li>
  <li><strong>Service-related information:</strong> details of the products or services you enquire about, including loan type, amount, and tenure preferences.</li>
  <li><strong>Communications:</strong> records of your correspondence with us, including emails, call recordings (where legally permitted), and chat transcripts.</li>
</ul>
<h3>2.2 Information Collected Automatically</h3>
<ul>
  <li><strong>Device and browser information:</strong> IP address, browser type and version, operating system, device identifiers, and screen resolution.</li>
  <li><strong>Usage data:</strong> pages visited, time spent on pages, referral URLs, click patterns, and the actions you take on our website.</li>
  <li><strong>Cookies and similar technologies:</strong> we may use cookies, local storage, and analytics tools to improve your browsing experience. You can disable cookies through your browser settings, although some features may not function properly.</li>
</ul>

<h2>3. How We Use Your Information</h2>
<p>We use the information we collect for the following purposes:</p>
<ul>
  <li>To process your loan enquiries and facilitate applications with banks, NBFCs, and other financial institutions.</li>
  <li>To verify your identity and eligibility, prevent fraud, and ensure the security of our services.</li>
  <li>To provide customer support and respond to your queries, requests, and complaints.</li>
  <li>To send you important service-related communications, such as application status updates and payment reminders.</li>
  <li>To improve our website, services, and user experience through analysis of usage patterns.</li>
  <li>To send you promotional offers, newsletters, and marketing communications, where you have opted in. You may unsubscribe at any time.</li>
  <li>To comply with legal, regulatory, and contractual obligations, including tax and audit requirements.</li>
</ul>

<h2>4. Legal Basis for Processing (DPDP Act Context)</h2>
<p>In compliance with the Digital Personal Data Protection Act, 2023 (DPDP Act), we process your personal data on one or more of the following lawful bases:</p>
<ul>
  <li><strong>Consent:</strong> where you have given us explicit consent to process your data for specific purposes.</li>
  <li><strong>Contractual necessity:</strong> where processing is necessary to provide services you have requested or to take steps before entering into a contract.</li>
  <li><strong>Legal obligation:</strong> where we must process data to comply with applicable laws and regulations.</li>
  <li><strong>Legitimate interest:</strong> where processing is necessary for our legitimate business interests, provided your rights and freedoms are not overridden.</li>
</ul>
<p>You have the right to withdraw your consent at any time by contacting us. Withdrawal of consent will not affect the lawfulness of processing based on consent before its withdrawal.</p>

<h2>5. Sharing and Disclosure of Information</h2>
<p>We do not sell, rent, or trade your personal information to third parties. We may share your information only in the following circumstances:</p>
<ul>
  <li><strong>With financial partners:</strong> your information may be shared with banks, NBFCs, insurance companies, and other lending institutions strictly for the purpose of processing your loan or financial product application.</li>
  <li><strong>With service providers:</strong> we may share data with trusted vendors who help us operate our website, manage IT infrastructure, provide analytics, or deliver communications. These vendors are bound by confidentiality agreements.</li>
  <li><strong>For legal compliance:</strong> we may disclose information when required by law, court order, or government authority, or when we believe such disclosure is necessary to protect our rights, safety, or property.</li>
  <li><strong>Business transfers:</strong> in the event of a merger, acquisition, or sale of assets, your information may be transferred as part of the transaction, subject to applicable law.</li>
</ul>
<p>Where we share your data with third parties, we take reasonable steps to ensure they provide adequate safeguards for your information.</p>

<h2>6. Data Security</h2>
<p>We implement reasonable technical, administrative, and physical safeguards to protect your personal information from unauthorised access, disclosure, alteration, and destruction. These measures include encrypted data transmission (SSL/TLS), restricted access controls, secure data storage, and regular security reviews.</p>
<p>However, no method of transmission over the internet or electronic storage is completely secure. While we strive to protect your data, we cannot guarantee absolute security. You are also responsible for keeping your login credentials, if any, confidential.</p>

<h2>7. Data Retention</h2>
<p>We retain your personal information only for as long as necessary to fulfil the purposes described in this policy, comply with legal obligations, resolve disputes, and enforce our agreements. When information is no longer required, we take reasonable steps to delete or anonymise it.</p>
<p>Records related to loan applications and financial transactions may be retained for the period required by applicable Indian laws and regulations, after which they are securely disposed of.</p>

<h2>8. Your Rights</h2>
<p>Subject to applicable law, you have the following rights regarding your personal information:</p>
<ul>
  <li><strong>Right to access:</strong> request a copy of the personal data we hold about you.</li>
  <li><strong>Right to correction:</strong> request correction of inaccurate or incomplete data.</li>
  <li><strong>Right to erasure:</strong> request deletion of your personal data in certain circumstances.</li>
  <li><strong>Right to withdraw consent:</strong> withdraw consent to processing where processing is based on consent.</li>
  <li><strong>Right to restrict processing:</strong> request restriction of processing in certain circumstances.</li>
  <li><strong>Right to data portability:</strong> request transfer of your data to another service provider, where technically feasible.</li>
  <li><strong>Right to complain:</strong> lodge a complaint with the appropriate data protection authority if you believe your rights have been violated.</li>
</ul>
<p>To exercise any of these rights, please contact us using the details provided in Section 11 of this policy. We will respond to your request within a reasonable timeframe, as required by law.</p>

<h2>9. Cookies and Tracking Technologies</h2>
<p>Our website may use cookies and similar technologies to enhance functionality and analyse usage. Cookies are small text files stored on your device. We use:</p>
<ul>
  <li><strong>Essential cookies:</strong> required for the website to function, such as session management.</li>
  <li><strong>Analytics cookies:</strong> help us understand how visitors interact with our site so we can improve it.</li>
  <li><strong>Preference cookies:</strong> remember your choices, such as language or region.</li>
</ul>
<p>You can control or delete cookies through your browser settings. Blocking all cookies may affect your experience and prevent some features from working correctly.</p>

<h2>10. Third-Party Links</h2>
<p>Our website may contain links to third-party websites, including those of banks, NBFCs, and other financial service providers. This Privacy Policy applies only to our website. We are not responsible for the privacy practices of third-party websites, and we encourage you to review their privacy policies before providing any personal information.</p>

<h2>11. Contact Us</h2>
<p>If you have any questions, concerns, or requests regarding this Privacy Policy or the handling of your personal data, please contact us:</p>
<p><strong>Pristine Finserve</strong><br>RT-89 &amp; 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304<br>Email: info@pristinefinserve.com<br>Phone: +91 9899360744</p>

<h2>12. Changes to This Privacy Policy</h2>
<p>We may update this Privacy Policy from time to time to reflect changes in our practices, technology, or legal requirements. We will notify you of any material changes by posting the updated policy on this page with a revised \"Last Updated\" date. We encourage you to review this page periodically to stay informed about how we protect your information.</p>
', 'Privacy Policy – Pristine Finserve', '1. Introduction
Pristine Finserve (\"we\", \"our\", \"us\", or \"the Company\") respects your privacy and is committed to protecting the personal information you share ', 'privacy-policy', 'default', 'published', 1),
('Terms of Service', 'terms-of-service', '<h2>1. Acceptance of Terms</h2>
<p>Welcome to the website of Pristine Finserve (\"we\", \"our\", \"us\", or the \"Company\"). These Terms and Conditions (\"Terms\") govern your access to and use of our website, including all content, tools, and services available through it. By accessing or using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms. If you do not agree with any part of these Terms, you must not use our website or services.</p>

<h2>2. About Our Services</h2>
<p>Pristine Finserve is a financial services consultancy that provides loan advisory, loan facilitation, financial planning, and related assistance. We help customers connect with banks, NBFCs, and other financial institutions for products such as home loans, personal loans, business loans, loan against property, auto loans, and education loans.</p>
<p>We act as an intermediary and advisor. We are not a lending institution and do not sanction or disburse loans directly. All loan approvals, interest rates, terms, and conditions are determined solely by the respective lending institutions based on their policies and your eligibility.</p>

<h2>3. Eligibility to Use Our Services</h2>
<p>You may use our website and services only if you are at least 18 years of age and legally capable of entering into a binding contract in India. By using our services, you represent and warrant that:</p>
<ul>
  <li>You are at least 18 years of age.</li>
  <li>All information you provide to us is true, accurate, current, and complete.</li>
  <li>You will promptly update any information that changes so that we can maintain accurate records.</li>
  <li>Your use of our services does not violate any applicable law or regulation.</li>
</ul>

<h2>4. Use of the Website</h2>
<p>You agree to use our website only for lawful purposes and in a manner that does not infringe the rights of, or restrict or inhibit the use of the website by, any third party. You specifically agree not to:</p>
<ul>
  <li>Use the website in any way that could damage, disable, overburden, or impair the website or interfere with any other party\'s use of the website.</li>
  <li>Attempt to gain unauthorised access to any part of the website, its servers, or connected systems.</li>
  <li>Upload or transmit any malicious code, viruses, or harmful software.</li>
  <li>Scrape, copy, or reproduce any content from the website without our prior written consent.</li>
  <li>Use the website to send unsolicited communications or engage in any fraudulent activity.</li>
  <li>Misrepresent your identity, eligibility, or financial information.</li>
</ul>
<p>We reserve the right to restrict, suspend, or terminate your access to the website at any time, with or without notice, for any reason, including a breach of these Terms.</p>

<h2>5. Loan Application Process</h2>
<p>When you submit a loan enquiry or application through our website:</p>
<ul>
  <li>We will collect the information required to assess your eligibility, including your personal, financial, and employment details.</li>
  <li>We may share your information with one or more partner financial institutions for the purpose of evaluating your application.</li>
  <li>We will communicate the offers available to you, including indicative interest rates, loan amounts, and tenures, based on information received from lenders.</li>
  <li>The final decision to sanction a loan, along with the applicable terms, rests exclusively with the lending institution.</li>
  <li>You are responsible for providing accurate and complete information. Misrepresentation may lead to rejection of your application or cancellation of an approved loan.</li>
</ul>
<p>Submission of an application does not guarantee loan approval. We do not make any representation or warranty that your loan application will be approved by any lender.</p>

<h2>6. Fees and Payments</h2>
<p>Our fee structure is transparent and is communicated to you before any service is rendered. Unless otherwise agreed in writing:</p>
<ul>
  <li>Initial consultation and loan eligibility checks are provided free of charge.</li>
  <li>Fees for dedicated advisory services, where applicable, are disclosed in advance and are payable as agreed.</li>
  <li>We do not charge any fee for the mere submission of a loan application.</li>
</ul>
<p>All payments, if any, shall be made through the modes specified by us. Any taxes, duties, or levies applicable shall be borne by you unless otherwise stated.</p>

<h2>7. Intellectual Property</h2>
<p>All content on our website, including text, graphics, logos, icons, images, audio clips, digital downloads, data compilations, and software, is the property of Pristine Finserve or its content suppliers and is protected by Indian and international copyright, trademark, and other intellectual property laws.</p>
<p>You may not reproduce, distribute, modify, create derivative works from, publicly display, or commercially exploit any content from our website without our prior written permission.</p>

<h2>8. Third-Party Services and Links</h2>
<p>Our website may include links to third-party websites, tools, or services. These links are provided for your convenience only. We do not control, endorse, or assume any responsibility for the content, products, or services offered by third parties. Your use of third-party services is subject to their own terms and conditions and privacy policies.</p>

<h2>9. Calculators and Tools</h2>
<p>Any calculators, tools, or estimators available on our website (such as EMI calculators) are provided for general informational purposes only. They provide approximate figures based on the inputs you provide and the assumptions built into the tool. They are not financial advice and should not be the sole basis for any financial decision. Actual loan amounts, interest rates, and EMIs will be determined by the lending institution.</p>

<h2>10. Limitation of Liability</h2>
<p>To the maximum extent permitted by applicable law, Pristine Finserve, its directors, employees, agents, and affiliates shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits, revenue, data, or goodwill, arising out of or in connection with your use of the website or services, even if we have been advised of the possibility of such damages.</p>
<p>Our total aggregate liability arising out of or in connection with these Terms or your use of the website shall not exceed the amount, if any, paid by you to us in connection with the relevant service during the three (3) months preceding the event giving rise to the liability.</p>

<h2>11. Disclaimers</h2>
<p>The website and its content are provided on an \"as is\" and \"as available\" basis without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, and non-infringement. We do not warrant that the website will be uninterrupted, error-free, or free of viruses or other harmful components.</p>

<h2>12. Indemnification</h2>
<p>You agree to indemnify, defend, and hold harmless Pristine Finserve, its directors, employees, agents, and affiliates from and against any claims, liabilities, damages, losses, costs, and expenses (including reasonable legal fees) arising out of or in connection with:</p>
<ul>
  <li>Your use of the website or services.</li>
  <li>Your violation of these Terms.</li>
  <li>Your violation of any rights of a third party.</li>
  <li>Any inaccurate or false information you provide to us.</li>
</ul>

<h2>13. Governing Law and Jurisdiction</h2>
<p>These Terms shall be governed by and construed in accordance with the laws of India. Any disputes arising out of or in connection with these Terms or your use of the website shall be subject to the exclusive jurisdiction of the courts located in New Delhi, India, and you irrevocably consent to such jurisdiction.</p>

<h2>14. Modifications to the Website and Terms</h2>
<p>We reserve the right to modify, suspend, or discontinue any part of the website at any time, with or without notice. We also reserve the right to update these Terms from time to time. Any changes will be effective immediately upon posting on this page. Your continued use of the website after any such changes constitutes your acceptance of the revised Terms. We encourage you to review these Terms periodically.</p>

<h2>15. Severability</h2>
<p>If any provision of these Terms is found to be invalid, illegal, or unenforceable, the remaining provisions shall continue in full force and effect. The invalid provision shall be modified to the minimum extent necessary to make it valid and enforceable.</p>

<h2>16. Waiver</h2>
<p>Our failure to enforce any provision of these Terms shall not be deemed a waiver of that provision or of our right to enforce it at any time thereafter. A waiver of any provision shall be effective only if in writing and signed by us.</p>

<h2>17. Entire Agreement</h2>
<p>These Terms, together with our Privacy Policy and Disclaimer, constitute the entire agreement between you and Pristine Finserve regarding your use of the website and services, and supersede all prior agreements and understandings, whether written or oral.</p>

<h2>18. Contact Information</h2>
<p>If you have any questions about these Terms, please contact us:</p>
<p><strong>Pristine Finserve</strong><br>RT-89 &amp; 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304<br>Email: info@pristinefinserve.com<br>Phone: +91 9899360744</p>
', 'Terms of Service – Pristine Finserve', '1. Acceptance of Terms
Welcome to the website of Pristine Finserve (\"we\", \"our\", \"us\", or the \"Company\"). These Terms and Conditions (\"Terms\") govern your acces', 'terms-of-service', 'default', 'published', 1),
('Refund & Cancellation Policy', 'refund-cancellation-policy', '<h2>1. Overview</h2>
<p>Pristine Finserve (\"we\", \"our\", \"us\") is committed to transparency in our fee structure and service delivery. This Refund & Cancellation Policy explains the terms under which fees paid to us for advisory and consultancy services may be refunded or cancelled.</p>
<p>Please note that Pristine Finserve acts as a loan facilitator and financial advisory service. We do not collect or process loan EMIs, down payments, or lender charges. All payments made directly to banks, NBFCs, or other financial institutions are governed by their respective refund and cancellation policies.</p>

<h2>2. Consultation Fees</h2>
<h3>2.1 Initial Consultation</h3>
<p>Initial loan eligibility assessment and basic consultation are provided free of charge. No fee is charged for the first interaction, profile review, or preliminary product matching.</p>

<h3>2.2 Dedicated Advisory Services</h3>
<p>Where a client engages us for dedicated, end-to-end loan processing, documentation assistance, or specialised financial planning beyond the initial consultation, applicable fees are clearly communicated in writing (via email or formal proposal) before any service is rendered.</p>
<p>Such fees, once agreed and the service has commenced, are generally <strong>non-refundable</strong> because they compensate for the time, expertise, and resources deployed by our team.</p>

<h2>3. Cancellation of Services</h2>
<h3>3.1 Cancellation by Client</h3>
<ul>
  <li>If you wish to cancel our advisory services before we have commenced substantive work (i.e., before document collection, lender outreach, or application submission), please notify us in writing via email. A full refund of any prepaid advisory fee will be processed within 7-10 business days.</li>
  <li>If substantive work has already begun (documents collected, applications submitted to lenders, follow-ups initiated), the advisory fee is non-refundable as the service has been partially or fully rendered.</li>
  <li>Any out-of-pocket expenses incurred on your behalf (e.g., credit report fees, verification charges paid to third parties) are non-refundable regardless of cancellation timing.</li>
</ul>

<h3>3.2 Cancellation by Pristine Finserve</h3>
<p>We reserve the right to discontinue services if:</p>
<ul>
  <li>The client provides inaccurate, misleading, or fraudulent information.</li>
  <li>The client fails to cooperate, provide required documents, or respond within reasonable timelines.</li>
  <li>There is a conflict of interest or regulatory restriction.</li>
</ul>
<p>In such cases, fees for services rendered up to the date of termination are payable. Any unused portion of a prepaid fee for services not yet rendered will be refunded.</p>

<h2>4. Loan Application Withdrawal</h2>
<p>If you decide to withdraw a loan application after it has been submitted to a lender through our facilitation:</p>
<ul>
  <li>Our advisory fee (if any) for the application process remains payable and is non-refundable.</li>
  <li>Any processing fees, login fees, or charges paid directly to the lender are subject to that lender\'s refund policy, which we have no control over. We will assist you in requesting a refund from the lender where applicable, but the outcome is at the lender\'s sole discretion.</li>
</ul>

<h2>5. Refund Process</h2>
<p>Where a refund is approved under this policy:</p>
<ul>
  <li>Refunds will be processed to the original mode of payment within 7-15 business days of approval.</li>
  <li>Refunds are issued in Indian Rupees (INR) only.</li>
  <li>Bank charges or payment gateway fees deducted at the time of the original transaction may not be refunded.</li>
</ul>

<h2>6. Disputes</h2>
<p>Any disputes arising from this Refund & Cancellation Policy shall be resolved in accordance with the Terms of Service and governed by the laws of India, subject to the exclusive jurisdiction of courts in New Delhi.</p>

<h2>7. Changes to This Policy</h2>
<p>We may update this policy from time to time. Changes will be posted on this page with a revised \"Last Updated\" date. We recommend reviewing this page periodically.</p>

<h2>8. Contact Us</h2>
<p>For any queries regarding refunds, cancellations, or this policy, please contact us:</p>
<p><strong>Pristine Finserve</strong><br>RT-89 & 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304<br>Email: info@pristinefinserve.com<br>Phone: +91 9899360744</p>', 'Refund & Cancellation Policy – Pristine Finserve', '1. Overview
Pristine Finserve (\"we\", \"our\", \"us\") is committed to transparency in our fee structure and service delivery. This Refund & Cancellation Policy expl', 'refund-cancellation-policy', 'default', 'published', 1),
('Disclaimer', 'disclaimer', '<h2>1. General Disclaimer</h2>
<p>The information provided on the Pristine Finserve website (\"Site\") is for general informational and educational purposes only. All content, including articles, calculators, guides, loan product descriptions, interest rate indications, and other materials, is provided \"as is\" without warranty of any kind, express or implied.</p>

<h2>2. No Financial Advice</h2>
<p>Nothing on this website constitutes financial, legal, tax, accounting, or investment advice. The content is not a substitute for professional advice tailored to your individual circumstances. You should consult with a qualified financial advisor, chartered accountant, or legal professional before making any financial decisions based on the information provided here.</p>

<h2>3. Loan Products and Interest Rates</h2>
<p>Loan products, interest rates, fees, tenure options, and eligibility criteria displayed on this website are indicative and based on publicly available information from partner banks, NBFCs, and financial institutions. These details are subject to change without notice and may vary based on your credit profile, income, employment, location, and the lender\'s internal policies at the time of application.</p>
<p>Pristine Finserve does not guarantee that you will receive any specific loan amount, interest rate, or approval. All final lending decisions are made solely by the respective financial institutions at their discretion.</p>

<h2>4. Accuracy of Information</h2>
<p>While we make reasonable efforts to keep the information on this Site accurate and up to date, we do not warrant or guarantee the completeness, accuracy, reliability, or timeliness of any content. Information may become outdated, contain errors, or be superseded by new policies. You use the information at your own risk.</p>

<h2>5. Third-Party Links</h2>
<p>This Site may contain links to third-party websites, including those of banks, NBFCs, insurance providers, and government portals. These links are provided for your convenience only. We do not control, endorse, or assume responsibility for the content, accuracy, privacy practices, or terms of use of any third-party website. Your use of external links is entirely at your own risk.</p>

<h2>6. Calculators and Tools</h2>
<p>Any calculators (e.g., EMI calculator, eligibility calculator) or estimation tools provided on this Site are for illustrative purposes only. The results are based on the inputs you provide and standard formulae; they do not represent actual loan offers or guaranteed outcomes. Actual EMIs, interest rates, and loan terms will be determined by the lending institution.</p>

<h2>7. Testimonials and Reviews</h2>
<p>Customer testimonials, reviews, and case studies displayed on this website reflect individual experiences and are not guarantees of future results. Outcomes vary based on individual financial situations, creditworthiness, and lender policies.</p>

<h2>8. No Endorsement</h2>
<p>References to specific banks, NBFCs, financial products, or services do not constitute an endorsement or recommendation by Pristine Finserve unless explicitly stated. We present options to help you make informed choices.</p>

<h2>9. Limitation of Liability</h2>
<p>To the fullest extent permitted by applicable law, Pristine Finserve, its directors, officers, employees, agents, and affiliates shall not be liable for any direct, indirect, incidental, consequential, special, or punitive damages, including but not limited to loss of profits, data, goodwill, or business opportunities, arising out of or in connection with your use of this Site or reliance on any information provided herein.</p>

<h2>10. Changes to This Disclaimer</h2>
<p>We reserve the right to update or modify this Disclaimer at any time without prior notice. The revised version will be effective immediately upon posting on this page. Your continued use of the Site after any changes constitutes acceptance of the updated Disclaimer.</p>

<h2>11. Contact Information</h2>
<p>If you have any questions regarding this Disclaimer, please contact us:</p>
<p><strong>Pristine Finserve</strong><br>RT-89 & 104, Tower C, Urbtech Trade Center, B Block, Sector 132, Noida, Uttar Pradesh-201304<br>Email: info@pristinefinserve.com<br>Phone: +91 9899360744</p>', 'Disclaimer – Pristine Finserve', '1. General Disclaimer
The information provided on the Pristine Finserve website (\"Site\") is for general informational and educational purposes only. All content', 'disclaimer', 'default', 'published', 1);

-- ============================================================


-- ============================================================
-- COUNTRY / STATE / CITY
-- ============================================================
INSERT INTO `pf_countries` (`id`, `name`, `code`, `status`) VALUES (1, 'India', 'IN', 'active');

INSERT INTO `pf_states` (`id`, `name`, `code`, `country_id`, `status`) VALUES
(1, 'Maharashtra', 'MH', 1, 'active'),
(2, 'Delhi', 'DL', 1, 'active'),
(3, 'Karnataka', 'KA', 1, 'active'),
(4, 'Tamil Nadu', 'TN', 1, 'active'),
(5, 'Gujarat', 'GJ', 1, 'active'),
(6, 'West Bengal', 'WB', 1, 'active'),
(7, 'Telangana', 'TS', 1, 'active'),
(8, 'Uttar Pradesh', 'UP', 1, 'active'),
(9, 'Rajasthan', 'RJ', 1, 'active'),
(10, 'Haryana', 'HR', 1, 'active');

INSERT INTO `pf_cities` (`name`, `state_id`, `status`) VALUES
('Mumbai', 1, 'active'),
('Pune', 1, 'active'),
('Nagpur', 1, 'active'),
('New Delhi', 2, 'active'),
('Bangalore', 3, 'active'),
('Chennai', 4, 'active'),
('Ahmedabad', 5, 'active'),
('Kolkata', 6, 'active'),
('Hyderabad', 7, 'active'),
('Lucknow', 8, 'active'),
('Jaipur', 9, 'active'),
('Gurugram', 10, 'active'),
('Noida', 8, 'active'),
('Surat', 5, 'active'),
('Indore', 8, 'active');

-- ============================================================
-- LEADS (Sample)
-- ============================================================
INSERT INTO `pf_leads` (`name`, `email`, `phone`, `loan_type`, `loan_amount`, `city`, `message`, `source`, `status`, `created_at`) VALUES
('Amit Sharma', 'amit.sharma@email.com', '9876543210', 'Home Loan', 5000000.00, 'Mumbai', 'Looking for a home loan to buy a 2BHK in Andheri.', 'website', 'new', '2025-12-20 10:30:00'),
('Priya Singh', 'priya.singh@email.com', '9876543211', 'Personal Loan', 500000.00, 'Delhi', 'Need a personal loan for my wedding expenses.', 'website', 'new', '2025-12-19 14:00:00'),
('Rohit Kumar', 'rohit.kumar@email.com', '9876543212', 'Business Loan', 2000000.00, 'Bangalore', 'Need working capital loan for my startup.', 'website', 'contacted', '2025-12-18 11:00:00'),
('Sneha Patel', 'sneha.patel@email.com', '9876543213', 'Home Loan', 7500000.00, 'Ahmedabad', 'Looking for home loan for a newly constructed flat.', 'website', 'new', '2025-12-17 09:00:00'),
('Vijay Reddy', 'vijay.reddy@email.com', '9876543214', 'Loan Against Property', 3000000.00, 'Hyderabad', 'Need a loan against my commercial property for business expansion.', 'website', 'new', '2025-12-16 16:00:00'),
('Anita Verma', 'anita.verma@email.com', '9876543215', 'Vehicle Loan', 800000.00, 'Pune', 'Looking for a car loan to buy a new SUV.', 'website', 'contacted', '2025-12-15 12:00:00');

-- ============================================================
-- NOTIFICATIONS (Sample)
-- ============================================================
INSERT INTO `pf_notifications` (`user_id`, `type`, `title`, `message`, `link`, `is_read`) VALUES
(1, 'lead', 'New Lead: Amit Sharma', 'A new home loan inquiry has been received from Amit Sharma for ₹50,00,000.', '/admin/leads', 0),
(1, 'lead', 'New Lead: Priya Singh', 'A new personal loan inquiry has been received from Priya Singh for ₹5,00,000.', '/admin/leads', 0),
(1, 'lead', 'New Lead: Sneha Patel', 'A new home loan inquiry has been received from Sneha Patel for ₹75,00,000.', '/admin/leads', 0),
(1, 'system', 'Welcome to Pristine Finserve', 'Your admin account has been created successfully. Welcome aboard!', '/admin/dashboard', 1);

-- ============================================================
-- ACTIVITY LOGS
-- ============================================================
INSERT INTO `pf_activity_logs` (`user_id`, `action`, `description`, `model`, `model_id`) VALUES
(1, 'login', 'Super Admin logged in from Mumbai', 'User', 1),
(1, 'create', 'Created new loan product: Education Loan', 'LoanProduct', 4),
(1, 'update', 'Updated settings: site_name, contact_email, social links', 'Setting', NULL),
(1, 'create', 'Added new team member: Neha Gupta', 'Team', 8),
(1, 'create', 'Published blog post: Complete Guide to Home Loans in India 2025', 'BlogPost', 1);

-- ============================================================
-- NOTIFICATION: ALL DONE
-- ============================================================
SELECT '✓ Seed data inserted successfully!' AS status;
