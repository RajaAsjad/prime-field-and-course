<style>
	.cms-card {
		background: #ffffff;
		border-radius: 16px;
		box-shadow: 0 8px 24px color-mix(in srgb, var(--admin-pink) 10%, transparent);
		border: 1px solid color-mix(in srgb, var(--admin-pink) 15%, transparent);
		overflow: hidden;
		margin-bottom: 20px;
	}
	.cms-card__header {
		background: linear-gradient(135deg, var(--admin-pink) 0%, var(--admin-pink-deep) 50%, var(--admin-orange) 100%) !important;
		color: #fff;
		padding: 18px 30px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 12px;
	}
	.cms-card__header h1, .cms-card__header h3 {
		margin: 0;
		font-size: 20px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #fff;
	}
	.cms-card__body { padding: 25px 30px; background: var(--admin-cream, #f0faf0); }
	.cms-btn-primary {
		background: var(--admin-pink) !important;
		color: #fff !important;
		border: none;
		padding: 8px 20px;
		border-radius: 9999px;
		font-weight: 600;
		text-decoration: none !important;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		transition: background 0.2s ease, transform 0.15s ease;
		box-shadow: 0 4px 14px color-mix(in srgb, var(--admin-pink) 35%, transparent);
	}
	.cms-btn-primary:hover {
		background: var(--admin-pink-deep) !important;
		color: #fff !important;
		transform: translateY(-1px);
	}
	.cms-table-wrap {
		background: #fff;
		border-radius: 12px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
		overflow: hidden;
	}
	.cms-table thead tr {
		background: linear-gradient(135deg, #e8f5e8 0%, #fff9e6 100%) !important;
	}
	.cms-table thead th {
		font-weight: 600;
		font-size: 13px;
		text-transform: uppercase;
		border: none !important;
		padding: 14px 12px;
	}
	.cms-table tbody tr:hover { background: color-mix(in srgb, var(--admin-pink) 6%, transparent); }
	.cms-form .form-group label { font-weight: 600; color: var(--admin-text); }
	.cms-form .form-control {
		border-radius: 10px;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 20%, transparent);
	}
	.cms-form .form-control:focus {
		border-color: var(--admin-pink);
		box-shadow: 0 0 0 3px color-mix(in srgb, var(--admin-pink) 18%, transparent);
	}
	.cms-stat-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
		gap: 16px;
		padding: 20px 30px 0;
		background: var(--admin-cream, #f0faf0);
	}
	.cms-stat {
		background: #fff;
		padding: 16px;
		border-radius: 12px;
		text-align: center;
		border: 1px solid color-mix(in srgb, var(--admin-pink) 12%, transparent);
	}
	.cms-stat .num {
		font-size: 22px;
		font-weight: 700;
		background: linear-gradient(135deg, var(--admin-pink), var(--admin-orange));
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}
	.cms-stat .lbl { font-size: 13px; color: #6b7280; margin-top: 4px; }
	.label-success { background: var(--admin-pink) !important; }
</style>
