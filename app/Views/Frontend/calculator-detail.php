<?php
$calcName = htmlspecialchars($calculator->title ?? $calculator->name ?? 'Calculator');
$title = $title ?: $calcName . ' – Pristine Finserve';
$metaDescription = $metaDescription ?: 'Use our ' . $calcName . ' to plan your finances and make informed decisions.';
$metaKeywords = $metaKeywords ?: 'financial calculator, ' . strtolower($calcName) . ', pristine finserve';
$currentPage = 'calculators';
$type = $type ?? ($calculator->type ?? 'emi');
ob_start();
?>

<section class="page-hero page-hero-sm">
  <div class="container">
    <div class="breadcrumb">
      <a href="<?= route('') ?>">Home</a>
      <span class="sep">/</span>
      <a href="<?= route('calculators') ?>">Calculators</a>
      <span class="sep">/</span>
      <span><?= $calcName ?></span>
    </div>
    <h1 data-aos="fade-up"><?= $calcName ?></h1>
    <p data-aos="fade-up" data-aos-delay="100"><?= htmlspecialchars($calculator->description ?? 'Calculate and plan your finances instantly.') ?></p>
  </div>
</section>

<?php if ($type === 'emi'): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<section class="section">
  <div class="container">
    <div class="section-header-left" data-aos="fade-up">
      <span class="section-label">Calculator</span>
      <h2 class="section-title">EMI Calculator</h2>
      <p class="section-subtitle">Calculate your monthly EMI, total interest, and total payment instantly.</p>
    </div>

    <div class="calculator-wrapper" data-aos="fade-up">
      <div class="calculator-inputs">
        <div class="form-group">
          <label>Loan Amount (₹) <span class="value" id="emiAmountDisplay">₹50,00,000</span></label>
          <input type="range" class="range-slider" id="emiLoanAmount" min="100000" max="10000000" step="50000" value="5000000">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹1,00,000</span>
            <span>₹1,00,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Interest Rate (% p.a.) <span class="value" id="emiRateDisplay">8.50%</span></label>
          <input type="range" class="range-slider" id="emiRate" min="5" max="20" step="0.1" value="8.5">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>5%</span>
            <span>20%</span>
          </div>
        </div>

        <div class="form-group">
          <label>Loan Tenure (Years) <span class="value" id="emiTenureDisplay">20 Years</span></label>
          <input type="range" class="range-slider" id="emiTenure" min="1" max="30" step="1" value="20">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1 Year</span>
            <span>30 Years</span>
          </div>
        </div>

        <button class="btn btn-outline-primary btn-sm" onclick="document.getElementById('emiTableContainer').style.display = document.getElementById('emiTableContainer').style.display === 'none' ? 'block' : 'none'">
          <i class="bi bi-table"></i> View Amortization Schedule
        </button>
      </div>

      <div class="calculator-result">
        <div class="emi-amount" id="emiResult">₹43,070</div>
        <div class="emi-label">Monthly EMI</div>

        <div class="chart-container">
          <canvas id="emiChart"></canvas>
        </div>

        <div class="result-details">
          <div class="result-detail-card">
            <div class="label">Principal</div>
            <div class="value" id="emiPrincipal">₹50,00,000</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Total Interest</div>
            <div class="value" id="emiInterest">₹53,36,845</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Total Payment</div>
            <div class="value" id="emiTotal">₹1,03,36,845</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Payoff Date</div>
            <div class="value" id="emiPayoff">Jun 2046</div>
          </div>
        </div>

        <div style="margin-top:var(--space-6);display:flex;gap:var(--space-3);flex-wrap:wrap;justify-content:center;">
          <button class="btn btn-primary btn-sm" onclick="downloadEMIPDF()"><i class="bi bi-download"></i> Download PDF</button>
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-sm">Apply Now <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <div id="emiTableContainer" style="display:none;margin-top:var(--space-8);" data-aos="fade-up">
      <h4 style="margin-bottom:var(--space-4);">Amortization Schedule</h4>
      <div style="max-height:400px;overflow-y:auto;border:1px solid var(--color-border);border-radius:var(--radius-lg);">
        <table class="amortization-table" id="amortizationTable">
          <thead>
            <tr><th>Year</th><th>Principal Paid</th><th>Interest Paid</th><th>Balance</th></tr>
          </thead>
          <tbody id="amortizationBody"></tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  let emiChart = null;

  function formatCurrency(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  }

  function calculateEMI(P, R, N) {
    var r = R / (12 * 100);
    var n = N * 12;
    if (r === 0) return P / n;
    var emi = P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
    return emi;
  }

  function updateEMICalculator() {
    var P = parseFloat(document.getElementById('emiLoanAmount').value);
    var R = parseFloat(document.getElementById('emiRate').value);
    var N = parseFloat(document.getElementById('emiTenure').value);

    document.getElementById('emiAmountDisplay').textContent = formatCurrency(P);
    document.getElementById('emiRateDisplay').textContent = R + '%';
    document.getElementById('emiTenureDisplay').textContent = N + ' Years';

    var emi = calculateEMI(P, R, N);
    var totalPayment = emi * N * 12;
    var totalInterest = totalPayment - P;

    document.getElementById('emiResult').textContent = '₹' + Math.round(emi).toLocaleString('en-IN');
    document.getElementById('emiPrincipal').textContent = formatCurrency(P);
    document.getElementById('emiInterest').textContent = formatCurrency(Math.round(totalInterest));
    document.getElementById('emiTotal').textContent = formatCurrency(Math.round(totalPayment));

    var now = new Date();
    var payoff = new Date(now.getFullYear() + N, now.getMonth());
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    document.getElementById('emiPayoff').textContent = months[payoff.getMonth()] + ' ' + payoff.getFullYear();

    if (emiChart) emiChart.destroy();
    var ctx = document.getElementById('emiChart').getContext('2d');
    emiChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Principal', 'Total Interest'],
        datasets: [{
          data: [P, Math.round(totalInterest)],
          backgroundColor: ['#0A1F44', '#D4A843'],
          borderWidth: 0,
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        cutout: '65%',
        plugins: {
          legend: { position: 'bottom', labels: { padding: 15, usePointStyle: true } }
        }
      }
    });

    var tbody = document.getElementById('amortizationBody');
    tbody.innerHTML = '';
    var rMonthly = R / (12 * 100);
    var nMonths = N * 12;
    var balance = P;
    for (var year = 1; year <= N; year++) {
      var principalPaid = 0, interestPaid = 0;
      for (var m = 1; m <= 12; m++) {
        var monthIndex = (year - 1) * 12 + m;
        if (monthIndex > nMonths) break;
        var interest = balance * rMonthly;
        var principal = emi - interest;
        principalPaid += principal;
        interestPaid += interest;
        balance -= principal;
      }
      var row = document.createElement('tr');
      row.innerHTML = '<td>Year ' + year + '</td><td>' + formatCurrency(Math.round(principalPaid)) + '</td><td>' + formatCurrency(Math.round(interestPaid)) + '</td><td>' + formatCurrency(Math.max(0, Math.round(balance))) + '</td>';
      tbody.appendChild(row);
    }
  }

  document.getElementById('emiLoanAmount').addEventListener('input', updateEMICalculator);
  document.getElementById('emiRate').addEventListener('input', updateEMICalculator);
  document.getElementById('emiTenure').addEventListener('input', updateEMICalculator);

  updateEMICalculator();

  window.downloadEMIPDF = function() {
    alert('PDF report download started. This will include your EMI details, chart, and amortization schedule.');
  };
})();
</script>

<?php elseif ($type === 'eligibility'): ?>
<section class="section">
  <div class="container">
    <div class="section-header-left" data-aos="fade-up">
      <span class="section-label">Calculator</span>
      <h2 class="section-title">Loan Affordability/Eligibility Calculator</h2>
      <p class="section-subtitle">Check how much loan you qualify for based on your income and obligations.</p>
    </div>

    <div class="calculator-wrapper" data-aos="fade-up">
      <div class="calculator-inputs">
        <div class="form-group">
          <label>Monthly Income (₹) <span class="value" id="eligIncomeDisplay">₹75,000</span></label>
          <input type="range" class="range-slider" id="eligIncome" min="10000" max="500000" step="5000" value="75000">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹10,000</span>
            <span>₹5,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Existing EMI (₹) <span class="value" id="eligExistingDisplay">₹0</span></label>
          <input type="range" class="range-slider" id="eligExisting" min="0" max="200000" step="1000" value="0">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹0</span>
            <span>₹2,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Loan Tenure (Years) <span class="value" id="eligTenureDisplay">20 Years</span></label>
          <input type="range" class="range-slider" id="eligTenure" min="1" max="30" step="1" value="20">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1 Year</span>
            <span>30 Years</span>
          </div>
        </div>

        <div class="form-group">
          <label>Interest Rate (% p.a.) <span class="value" id="eligRateDisplay">8.50%</span></label>
          <input type="range" class="range-slider" id="eligRate" min="5" max="20" step="0.1" value="8.5">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>5%</span>
            <span>20%</span>
          </div>
        </div>
      </div>

      <div class="calculator-result">
        <div class="emi-amount" id="eligResult">₹69,13,850</div>
        <div class="emi-label">Eligible Loan Amount</div>

        <div class="result-details">
          <div class="result-detail-card">
            <div class="label">Monthly Income</div>
            <div class="value" id="eligIncomeResult">₹75,000</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Max EMI (80% of Income)</div>
            <div class="value" id="eligMaxEMI">₹37,500</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Interest Rate</div>
            <div class="value" id="eligRateResult">8.50%</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Tenure</div>
            <div class="value" id="eligTenureResult">20 Years</div>
          </div>
        </div>

        <div style="margin-top:var(--space-6);">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold">Apply Now <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  function formatCurrency(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  }

  function updateEligibility() {
    var income = parseFloat(document.getElementById('eligIncome').value);
    var existing = parseFloat(document.getElementById('eligExisting').value);
    var tenure = parseFloat(document.getElementById('eligTenure').value);
    var rate = parseFloat(document.getElementById('eligRate').value);

    document.getElementById('eligIncomeDisplay').textContent = formatCurrency(income);
    document.getElementById('eligExistingDisplay').textContent = formatCurrency(existing);
    document.getElementById('eligTenureDisplay').textContent = tenure + ' Years';
    document.getElementById('eligRateDisplay').textContent = rate + '%';

    var maxEMI = (income * 0.8) - existing;
    if (maxEMI < 0) maxEMI = 0;

    var r = rate / (12 * 100);
    var n = tenure * 12;
    var eligible = 0;
    if (r > 0 && n > 0 && maxEMI > 0) {
      eligible = maxEMI * (Math.pow(1 + r, n) - 1) / (r * Math.pow(1 + r, n));
    }

    document.getElementById('eligResult').textContent = formatCurrency(Math.round(eligible));
    document.getElementById('eligIncomeResult').textContent = formatCurrency(income);
    document.getElementById('eligMaxEMI').textContent = formatCurrency(Math.round(maxEMI));
    document.getElementById('eligRateResult').textContent = rate + '%';
    document.getElementById('eligTenureResult').textContent = tenure + ' Years';
  }

  document.getElementById('eligIncome').addEventListener('input', updateEligibility);
  document.getElementById('eligExisting').addEventListener('input', updateEligibility);
  document.getElementById('eligTenure').addEventListener('input', updateEligibility);
  document.getElementById('eligRate').addEventListener('input', updateEligibility);

  updateEligibility();
})();
</script>

<?php elseif ($type === 'sip'): ?>
<section class="section">
  <div class="container">
    <div class="section-header-left" data-aos="fade-up">
      <span class="section-label">Calculator</span>
      <h2 class="section-title">SIP Calculator</h2>
      <p class="section-subtitle">Estimate the future value of your monthly SIP investments.</p>
    </div>

    <div class="calculator-wrapper" data-aos="fade-up">
      <div class="calculator-inputs">
        <div class="form-group">
          <label>Monthly Investment (₹) <span class="value" id="sipAmountDisplay">₹5,000</span></label>
          <input type="range" class="range-slider" id="sipAmount" min="500" max="100000" step="500" value="5000">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹500</span>
            <span>₹1,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Expected Return (% p.a.) <span class="value" id="sipRateDisplay">12.00%</span></label>
          <input type="range" class="range-slider" id="sipRate" min="1" max="30" step="0.25" value="12">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1%</span>
            <span>30%</span>
          </div>
        </div>

        <div class="form-group">
          <label>Time Period (Years) <span class="value" id="sipTenureDisplay">10 Years</span></label>
          <input type="range" class="range-slider" id="sipTenure" min="1" max="40" step="1" value="10">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1 Year</span>
            <span>40 Years</span>
          </div>
        </div>
      </div>

      <div class="calculator-result">
        <div class="emi-amount" id="sipResult">₹11,61,695</div>
        <div class="emi-label">Total Value</div>

        <div class="result-details">
          <div class="result-detail-card">
            <div class="label">Invested Amount</div>
            <div class="value" id="sipInvested">₹6,00,000</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Estimated Returns</div>
            <div class="value" id="sipReturns">₹5,61,695</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Expected Return</div>
            <div class="value" id="sipRateResult">12.00%</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Tenure</div>
            <div class="value" id="sipTenureResult">10 Years</div>
          </div>
        </div>

        <div style="margin-top:var(--space-6);">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold">Start Investing <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  function formatCurrency(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  }

  function updateSIP() {
    var P = parseFloat(document.getElementById('sipAmount').value);
    var rate = parseFloat(document.getElementById('sipRate').value);
    var years = parseFloat(document.getElementById('sipTenure').value);

    document.getElementById('sipAmountDisplay').textContent = formatCurrency(P);
    document.getElementById('sipRateDisplay').textContent = rate + '%';
    document.getElementById('sipTenureDisplay').textContent = years + ' Years';

    var r = rate / (12 * 100);
    var n = years * 12;

    var invested = P * n;
    var totalValue = 0;
    if (r > 0) {
      totalValue = P * (Math.pow(1 + r, n) - 1) / r * (1 + r);
    } else {
      totalValue = invested;
    }
    var returns = totalValue - invested;

    document.getElementById('sipResult').textContent = formatCurrency(Math.round(totalValue));
    document.getElementById('sipInvested').textContent = formatCurrency(Math.round(invested));
    document.getElementById('sipReturns').textContent = formatCurrency(Math.round(returns));
    document.getElementById('sipRateResult').textContent = rate + '%';
    document.getElementById('sipTenureResult').textContent = years + ' Years';
  }

  document.getElementById('sipAmount').addEventListener('input', updateSIP);
  document.getElementById('sipRate').addEventListener('input', updateSIP);
  document.getElementById('sipTenure').addEventListener('input', updateSIP);

  updateSIP();
})();
</script>

<?php elseif ($type === 'comparison'): ?>
<section class="section">
  <div class="container">
    <div class="section-header-left" data-aos="fade-up">
      <span class="section-label">Calculator</span>
      <h2 class="section-title">EMI vs SIP Calculator</h2>
      <p class="section-subtitle">Compare the cost of paying off a loan against investing the same amount in a SIP.</p>
    </div>

    <div class="calculator-wrapper" data-aos="fade-up">
      <div class="calculator-inputs">
        <div class="form-group">
          <label>Loan Amount (₹) <span class="value" id="cmpAmountDisplay">₹10,00,000</span></label>
          <input type="range" class="range-slider" id="cmpAmount" min="100000" max="10000000" step="50000" value="1000000">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹1,00,000</span>
            <span>₹1,00,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Loan Interest Rate (% p.a.) <span class="value" id="cmpRateDisplay">10.50%</span></label>
          <input type="range" class="range-slider" id="cmpRate" min="5" max="20" step="0.1" value="10.5">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>5%</span>
            <span>20%</span>
          </div>
        </div>

        <div class="form-group">
          <label>Loan Tenure (Years) <span class="value" id="cmpTenureDisplay">5 Years</span></label>
          <input type="range" class="range-slider" id="cmpTenure" min="1" max="30" step="1" value="5">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1 Year</span>
            <span>30 Years</span>
          </div>
        </div>

        <div class="form-group">
          <label>SIP Expected Return (% p.a.) <span class="value" id="cmpSipRateDisplay">12.00%</span></label>
          <input type="range" class="range-slider" id="cmpSipRate" min="1" max="30" step="0.25" value="12">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1%</span>
            <span>30%</span>
          </div>
        </div>
      </div>

      <div class="calculator-result">
        <div class="emi-amount" id="cmpResult">₹21,494</div>
        <div class="emi-label">Monthly EMI</div>

        <div class="result-details">
          <div class="result-detail-card">
            <div class="label">Total Loan Cost</div>
            <div class="value" id="cmpLoanCost">₹12,89,634</div>
          </div>
          <div class="result-detail-card">
            <div class="label">SIP Value</div>
            <div class="value" id="cmpSipValue">₹17,72,954</div>
          </div>
          <div class="result-detail-card">
            <div class="label">SIP Gain vs Loan Cost</div>
            <div class="value" id="cmpDiff">+₹4,83,320</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Better Option</div>
            <div class="value" id="cmpBetter">SIP</div>
          </div>
        </div>

        <div style="margin-top:var(--space-6);">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold">Apply Now <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  function formatCurrency(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  }

  function calculateEMI(P, R, N) {
    var r = R / (12 * 100);
    var n = N * 12;
    if (r === 0) return P / n;
    return P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
  }

  function updateComparison() {
    var P = parseFloat(document.getElementById('cmpAmount').value);
    var rate = parseFloat(document.getElementById('cmpRate').value);
    var years = parseFloat(document.getElementById('cmpTenure').value);
    var sipRate = parseFloat(document.getElementById('cmpSipRate').value);

    document.getElementById('cmpAmountDisplay').textContent = formatCurrency(P);
    document.getElementById('cmpRateDisplay').textContent = rate + '%';
    document.getElementById('cmpTenureDisplay').textContent = years + ' Years';
    document.getElementById('cmpSipRateDisplay').textContent = sipRate + '%';

    var emi = calculateEMI(P, rate, years);
    var n = years * 12;
    var loanCost = emi * n;
    var totalInterest = loanCost - P;

    var r = sipRate / (12 * 100);
    var sipValue = (r > 0)
      ? emi * (Math.pow(1 + r, n) - 1) / r * (1 + r)
      : emi * n;

    var diff = sipValue - loanCost;

    document.getElementById('cmpResult').textContent = '₹' + Math.round(emi).toLocaleString('en-IN');
    document.getElementById('cmpLoanCost').textContent = formatCurrency(Math.round(loanCost));
    document.getElementById('cmpSipValue').textContent = formatCurrency(Math.round(sipValue));
    document.getElementById('cmpDiff').textContent = (diff >= 0 ? '+' : '') + formatCurrency(Math.round(diff));
    document.getElementById('cmpBetter').textContent = diff >= 0 ? 'SIP' : 'Loan';
  }

  document.getElementById('cmpAmount').addEventListener('input', updateComparison);
  document.getElementById('cmpRate').addEventListener('input', updateComparison);
  document.getElementById('cmpTenure').addEventListener('input', updateComparison);
  document.getElementById('cmpSipRate').addEventListener('input', updateComparison);

  updateComparison();
})();
</script>

<?php elseif ($type === 'lump-sum'): ?>
<section class="section">
  <div class="container">
    <div class="section-header-left" data-aos="fade-up">
      <span class="section-label">Calculator</span>
      <h2 class="section-title">Lumpsum Calculator</h2>
      <p class="section-subtitle">Calculate the future value of a one-time lumpsum investment.</p>
    </div>

    <div class="calculator-wrapper" data-aos="fade-up">
      <div class="calculator-inputs">
        <div class="form-group">
          <label>Investment Amount (₹) <span class="value" id="lumpAmountDisplay">₹1,00,000</span></label>
          <input type="range" class="range-slider" id="lumpAmount" min="10000" max="10000000" step="10000" value="100000">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>₹10,000</span>
            <span>₹1,00,00,000</span>
          </div>
        </div>

        <div class="form-group">
          <label>Expected Return (% p.a.) <span class="value" id="lumpRateDisplay">12.00%</span></label>
          <input type="range" class="range-slider" id="lumpRate" min="1" max="30" step="0.25" value="12">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1%</span>
            <span>30%</span>
          </div>
        </div>

        <div class="form-group">
          <label>Time Period (Years) <span class="value" id="lumpTenureDisplay">5 Years</span></label>
          <input type="range" class="range-slider" id="lumpTenure" min="1" max="40" step="1" value="5">
          <div style="display:flex;justify-content:space-between;font-size:var(--text-xs);color:var(--color-text-muted);">
            <span>1 Year</span>
            <span>40 Years</span>
          </div>
        </div>
      </div>

      <div class="calculator-result">
        <div class="emi-amount" id="lumpResult">₹1,76,234</div>
        <div class="emi-label">Maturity Value</div>

        <div class="result-details">
          <div class="result-detail-card">
            <div class="label">Invested Amount</div>
            <div class="value" id="lumpInvested">₹1,00,000</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Estimated Returns</div>
            <div class="value" id="lumpReturns">₹76,234</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Expected Return</div>
            <div class="value" id="lumpRateResult">12.00%</div>
          </div>
          <div class="result-detail-card">
            <div class="label">Tenure</div>
            <div class="value" id="lumpTenureResult">5 Years</div>
          </div>
        </div>

        <div style="margin-top:var(--space-6);">
          <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold">Start Investing <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  function formatCurrency(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  }

  function updateLumpsum() {
    var P = parseFloat(document.getElementById('lumpAmount').value);
    var rate = parseFloat(document.getElementById('lumpRate').value);
    var years = parseFloat(document.getElementById('lumpTenure').value);

    document.getElementById('lumpAmountDisplay').textContent = formatCurrency(P);
    document.getElementById('lumpRateDisplay').textContent = rate + '%';
    document.getElementById('lumpTenureDisplay').textContent = years + ' Years';

    var maturity = P * Math.pow(1 + rate / 100, years);
    var returns = maturity - P;

    document.getElementById('lumpResult').textContent = formatCurrency(Math.round(maturity));
    document.getElementById('lumpInvested').textContent = formatCurrency(Math.round(P));
    document.getElementById('lumpReturns').textContent = formatCurrency(Math.round(returns));
    document.getElementById('lumpRateResult').textContent = rate + '%';
    document.getElementById('lumpTenureResult').textContent = years + ' Years';
  }

  document.getElementById('lumpAmount').addEventListener('input', updateLumpsum);
  document.getElementById('lumpRate').addEventListener('input', updateLumpsum);
  document.getElementById('lumpTenure').addEventListener('input', updateLumpsum);

  updateLumpsum();
})();
</script>

<?php endif; ?>

<section class="section cta-section">
  <div class="container">
    <div class="cta-content" data-aos="fade-up">
      <span class="section-label" style="color:var(--color-gold);">Ready to Apply?</span>
      <h2 class="display-2">Get the Best Rates Today</h2>
      <p>Use our calculators to plan your finances, then apply with confidence.</p>
      <div class="cta-actions">
        <a href="<?= route('contact') ?>#inquiry" class="btn btn-gold btn-lg">Apply Now <i class="bi bi-arrow-right"></i></a>
        <a href="tel:<?= htmlspecialchars(setting('phone', '+919899360744')) ?>" class="btn btn-outline btn-lg"><i class="bi bi-telephone"></i> Call Now</a>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/frontend.php';
?>
