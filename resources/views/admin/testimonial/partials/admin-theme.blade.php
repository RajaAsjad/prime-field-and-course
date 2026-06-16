<style>
	.tst-card {
		background: #ffffff;
		border-radius: 16px;
		box-shadow: 0 8px 24px color-mix(in srgb, var(--admin-pink) 10%, transparent);
		border: 1px solid color-mix(in srgb, var(--admin-pink) 15%, transparent);
		overflow: hidden;
	}
	.tst-header {
		background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-pink-deep) 50%, var(--admin-orange) 100%) !important;
		color: #fff;
		padding: 18px 30px;
		border-radius: 16px 16px 0 0;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
		box-shadow: 0 4px 16px color-mix(in srgb, var(--admin-pink) 25%, transparent);
		text-align: center;
	}
	.tst-header h1, .tst-header h3 {
		margin: 0;
		font-size: 22px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #fff;
	}
	.tst-stats {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 20px;
		padding: 25px 30px 0;
		background: var(--admin-cream, #f0faf0);
		margin-bottom: 20px;
	}
	.tst-stats .stat-box {
		background: #fff;
		padding: 18px;
		border-radius: 12px;
		box-shadow: 0 2px 8px color-mix(in srgb, var(--admin-pink) 8%, transparent);
		border: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
		text-align: center;
		margin-bottom: 20px;
	}
	.tst-stats .stat-box .num {
		font-size: 22px;
		font-weight: 700;
		background: linear-gradient(135deg, var(--admin-pink), var(--admin-orange));
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}
	.tst-stats .stat-box .lbl { font-size: 13px; color: #6b7280; font-weight: 500; margin-top: 4px; }
	.tst-btn-primary {
		background: var(--admin-pink) !important;
		color: #fff !important;
		border: none;
		border-radius: 9999px;
		padding: 10px 20px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
		box-shadow: 0 4px 14px color-mix(in srgb, var(--admin-pink) 35%, transparent);
	}
	.tst-btn-primary:hover {
		background: var(--admin-pink-deep) !important;
		color: #fff !important;
		transform: translateY(-1px);
		box-shadow: 0 6px 20px color-mix(in srgb, var(--admin-pink) 40%, transparent);
	}
	.tst-search {
		background: #fafaf9;
		padding: 20px 30px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 10%, transparent);
		margin: 0 30px 20px;
		border-radius: 12px;
	}
	.tst-search .form-control {
		border: 1px solid color-mix(in srgb, var(--admin-pink) 20%, transparent);
		border-radius: 10px;
		font-size: 14px;
		background: #fff;
		transition: border-color 0.2s ease, box-shadow 0.2s ease;
	}
	.tst-search .form-control:focus {
		border-color: var(--admin-pink);
		box-shadow: 0 0 0 3px color-mix(in srgb, var(--admin-pink) 18%, transparent);
		outline: none;
	}
	.tst-body { padding: 15px 30px 25px; background: var(--admin-cream, #f0faf0); }
	.tst-table-wrap {
		background: #fff;
		border-radius: 12px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
		overflow: hidden;
		box-shadow: 0 2px 8px color-mix(in srgb, var(--admin-pink) 6%, transparent);
	}
	.tst-table thead tr {
		background: linear-gradient(135deg, #e8f5e8 0%, #fff9e6 100%) !important;
		border-bottom: 1px solid color-mix(in srgb, var(--admin-pink) 20%, transparent);
	}
	.tst-table thead th {
		font-weight: 600;
		color: #1a1a1a;
		font-size: 13px;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		padding: 14px 12px;
		border: none;
	}
	.tst-table tbody tr:hover { background: color-mix(in srgb, var(--admin-pink) 6%, transparent); }
	.tst-table tbody td {
		padding: 12px;
		vertical-align: middle;
		font-size: 14px;
		color: #374151;
		border-color: color-mix(in srgb, var(--admin-pink) 10%, transparent);
	}
	.tst-table tbody td img {
		width: 60px;
		height: 60px;
		object-fit: cover;
		border-radius: 8px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 15%, transparent);
	}
	.tst-table .label-success { background: var(--admin-pink) !important; }
	.tst-table .btn-edit {
		background: var(--admin-pink) !important;
		border: none;
		color: #fff !important;
		font-weight: 600;
		padding: 5px 12px;
		border-radius: 9999px;
		font-size: 12px;
		text-decoration: none !important;
		white-space: nowrap;
		transition: background 0.2s ease, transform 0.15s ease;
	}
	.tst-table .btn-edit:hover {
		background: var(--admin-pink-deep) !important;
		color: #fff !important;
		transform: translateY(-1px);
	}
	.tst-alert-success {
		background: #ecfdf5;
		border: 1px solid #10b981;
		border-radius: 10px;
		padding: 12px 16px;
		color: #047857;
		font-weight: 500;
		margin-bottom: 20px;
	}

	/* Form pages (create / edit) */
	.tst-form-container {
		background: #fff;
		border-radius: 16px;
		box-shadow: 0 8px 24px color-mix(in srgb, var(--admin-pink) 10%, transparent);
		border: 1px solid color-mix(in srgb, var(--admin-pink) 15%, transparent);
		overflow: hidden;
		margin: 20px 0;
	}
	.tst-form-body { padding: 0 30px 40px; background: var(--admin-cream, #f0faf0); }
	.tst-form-banner {
		background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-pink-deep) 50%, var(--admin-orange) 100%) !important;
		padding: 18px 24px;
		margin: 0 -30px 25px;
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
		border-bottom: 1px solid rgba(255, 255, 255, 0.2);
	}
	.tst-form-banner h3 {
		margin: 0;
		font-size: 18px;
		font-weight: 700;
		color: #fff;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.tst-form-banner .btn-back {
		position: absolute;
		right: 20px;
		background: rgba(255, 255, 255, 0.15) !important;
		color: #fff !important;
		border: 1px solid rgba(255, 255, 255, 0.35);
		padding: 8px 20px;
		border-radius: 9999px;
		font-size: 13px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		transition: background 0.2s ease, transform 0.15s ease;
	}
	.tst-form-banner .btn-back:hover {
		background: rgba(255, 255, 255, 0.28) !important;
		color: #fff !important;
		transform: translateY(-1px);
	}
	.tst-form-container .form-group { margin-bottom: 22px; }
	.tst-form-container .form-group label {
		display: block;
		margin-bottom: 8px;
		font-weight: 600;
		color: var(--admin-text, #0d1a0d);
		font-size: 14px;
	}
	.tst-form-container .required { color: #dc2626; margin-left: 3px; }
	.tst-form-container .form-control {
		border: 1px solid color-mix(in srgb, var(--admin-pink) 20%, transparent);
		border-radius: 10px;
		font-size: 14px;
		padding: 8px 12px;
		transition: border-color 0.2s ease, box-shadow 0.2s ease;
	}
	.tst-form-container .form-control:focus {
		border-color: var(--admin-pink);
		box-shadow: 0 0 0 3px color-mix(in srgb, var(--admin-pink) 18%, transparent);
		outline: none;
	}
	.tst-form-container .image-preview-section img {
		max-width: 150px;
		border-radius: 10px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 15%, transparent);
		padding: 4px;
		background: #fff;
		margin-top: 10px;
	}
	.tst-form-container .current-file {
		margin-top: 10px;
		padding: 10px 12px;
		background: #e8f5e8;
		border-radius: 8px;
		font-size: 13px;
		color: #374151;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
	}
	.tst-form-container .action-section {
		margin-top: 28px;
		padding-top: 20px;
		border-top: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
	}
	.tst-form-container .btn-submit {
		background: var(--admin-pink);
		color: #fff;
		border: none;
		padding: 12px 28px;
		border-radius: 9999px;
		font-weight: 600;
		font-size: 14px;
		cursor: pointer;
		transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
		box-shadow: 0 4px 14px color-mix(in srgb, var(--admin-pink) 35%, transparent);
	}
	.tst-form-container .btn-submit:hover {
		background: var(--admin-pink-deep);
		transform: translateY(-1px);
		box-shadow: 0 6px 20px color-mix(in srgb, var(--admin-pink) 40%, transparent);
	}
	.tst-form-container .btn-submit i { margin-right: 8px; }
</style>
