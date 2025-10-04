<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Dapur MBG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body { background: #DDDFC2; } 
    .sidebar {
      width: 220px;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      background: #1C2D2A; 
      padding: 20px 0;
      color: #fff;
    }
    .sidebar a {
      display: block;
      padding: 10px 20px;
      color: #DDDFC2;
      text-decoration: none;
    }
    .sidebar a:hover {
      background: #97AC82;
    }
    .content {
      margin-left: 220px;
      padding: 20px;
    }
    .topbar {
      background: #97AC82; 
      padding: 10px 20px;
      color: #2C341B;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center mb-4">
      <i class="fa fa-utensils me-2"></i> Dapur - MBG
    </h4>
    <a href="#"><i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="/logout"><i class="fa fa-sign-out-alt me-2"></i> Logout</a>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Topbar -->
    <div class="topbar">
      <h5><i class="fa fa-utensils me-2"></i> Dashboard Dapur</h5>
      <div>
        <span class="me-3"><?= session()->get('name'); ?> (<?= session()->get('role'); ?>)</span>
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="35" class="rounded-circle">
      </div>
    </div>
  </div>

</body>
</html>
