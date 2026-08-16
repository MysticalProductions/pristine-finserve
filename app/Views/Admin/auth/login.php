<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Pristine Finserve Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #0A1F44 0%, #152d5e 50%, #1a3666 100%);
      padding: 20px;
    }
    .login-wrapper {
      width: 100%;
      max-width: 420px;
    }
    .login-card {
      background: #FFFFFF;
      border-radius: 12px;
      padding: 40px 36px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }
    .login-logo {
      text-align: center;
      margin-bottom: 8px;
    }
    .login-logo .logo-icon {
      width: 56px; height: 56px;
      background: linear-gradient(135deg, #D4A843, #c49632);
      border-radius: 12px;
      display: inline-flex; align-items: center; justify-content: center;
      font-weight: 800; font-size: 1.2rem; color: #FFFFFF;
      margin-bottom: 12px;
    }
    .login-logo .logo-text {
      font-size: 1.4rem; font-weight: 700; color: #0A1F44;
    }
    .login-logo .logo-text span { color: #D4A843; }
    .login-title {
      text-align: center;
      font-size: 1.1rem;
      font-weight: 600;
      color: #0F172A;
      margin-bottom: 4px;
    }
    .login-subtitle {
      text-align: center;
      font-size: 0.85rem;
      color: #94A3B8;
      margin-bottom: 28px;
    }
    .form-group {
      margin-bottom: 18px;
    }
    .form-group label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      color: #0F172A;
      margin-bottom: 5px;
    }
    .form-control {
      width: 100%;
      padding: 11px 14px;
      font-family: 'Nunito', sans-serif;
      font-size: 0.9rem;
      color: #0F172A;
      background: #FFFFFF;
      border: 1.5px solid #E2E8F0;
      border-radius: 8px;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
    }
    .form-control:focus {
      border-color: #D4A843;
      box-shadow: 0 0 0 3px rgba(212,168,67,0.12);
    }
    .form-control::placeholder { color: #94A3B8; }
    .input-group {
      position: relative;
    }
    .input-group .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94A3B8;
      font-size: 0.9rem;
    }
    .input-group .form-control {
      padding-left: 40px;
    }
    .btn {
      display: block;
      width: 100%;
      padding: 12px 24px;
      font-family: 'Nunito', sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.15s ease;
      background: linear-gradient(135deg, #D4A843, #c49632);
      color: #FFFFFF;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(212,168,67,0.35);
    }
    .btn:active { transform: translateY(0); }
    .login-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.8rem;
    }
    .login-footer a {
      color: #1B5AAE;
      text-decoration: none;
      font-weight: 500;
    }
    .login-footer a:hover { color: #D4A843; }
    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 500;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .alert-danger {
      background: rgba(239,68,68,0.08);
      color: #DC2626;
      border: 1px solid rgba(239,68,68,0.15);
    }
    .alert-success {
      background: rgba(16,185,129,0.08);
      color: #059669;
      border: 1px solid rgba(16,185,129,0.15);
    }
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: rgba(255,255,255,0.6);
      text-decoration: none;
      font-size: 0.85rem;
      margin-top: 16px;
      transition: color 0.15s;
    }
    .back-link:hover { color: #D4A843; }
    .error-summary {
      background: rgba(239,68,68,0.08);
      border: 1px solid rgba(239,68,68,0.15);
      border-radius: 8px;
      padding: 12px 16px;
      margin-bottom: 20px;
    }
    .error-summary p {
      color: #DC2626;
      font-size: 0.85rem;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-logo">
        <img src="/assets/images/logo.png" alt="Pristine Finserve" style="height:56px;width:auto;margin-bottom:12px;">
        <div class="logo-text">Pristine<span>Finserve</span></div>
      </div>
      <div class="login-title">Admin Login</div>
      <div class="login-subtitle">Sign in to access the admin panel</div>

      <?php if ($flash = flash('error')): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>
      <?php if ($flash = flash('success')): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($flash) ?></div>
      <?php endif; ?>
      <?php if (!empty($errors) && is_array($errors)): ?>
        <div class="error-summary">
          <?php foreach ($errors as $error): ?>
            <p><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="/admin/login">
        <?= csrfField() ?>
        <div class="form-group">
          <label for="email">Email Address</label>
          <div class="input-group">
            <i class="fas fa-envelope input-icon"></i>
            <input type="email" class="form-control" id="email" name="email" placeholder="admin@pristinefinserve.com" required value="<?= htmlspecialchars($email ?? '') ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <div class="input-group">
            <i class="fas fa-lock input-icon"></i>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          </div>
        </div>
        <button type="submit" class="btn">
          <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
      </form>
    </div>

    <div style="text-align:center;">
      <a href="/" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Website
      </a>
    </div>
  </div>
</body>
</html>
