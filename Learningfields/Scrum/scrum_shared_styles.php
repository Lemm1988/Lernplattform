<?php
if (!defined('SCRUM_SHARED_STYLES')) {
    define('SCRUM_SHARED_STYLES', true);
?>
<style>
.page-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.page-content section,
.page-content .summary-section,
.page-content .practice-section {
    background: #ffffff;
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid #e1e7ff;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
}

.page-content section h2,
.page-content .summary-section h2 {
    margin-bottom: 1.25rem;
    font-weight: 600;
    color: #0d6efd;
}

.page-content .info-box,
.page-content .warning-box,
.page-content .tip-box,
.page-content .key-takeaway {
    border-radius: 10px;
    padding: 1.25rem 1.5rem;
    border: 1px solid transparent;
    box-shadow: none;
    margin-bottom: 1rem;
}

.page-content .info-box {
    background: #eef5ff;
    border-left: 4px solid #0d6efd;
}

.page-content .warning-box {
    background: #fff5f5;
    border-left: 4px solid #dc3545;
}

.page-content .tip-box {
    background: #e0f7ff;
    border-left: 4px solid #0aa2c0;
}

.page-content .key-takeaway {
    background: #ecfdf5;
    border-left: 4px solid #0f9d58;
}

.page-content .card {
    background: #f8f9fa;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 1.25rem 1.5rem;
    margin-bottom: 1rem;
    box-shadow: none;
}

.page-content .card h3 {
    font-size: 1.15rem;
    color: #0b5ed7;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.page-content .card h4 {
    font-size: 1rem;
    margin: 1rem 0 0.5rem;
    color: #0b5ed7;
}

.page-content ul {
    padding-left: 1.25rem;
}

.page-content li + li {
    margin-top: 0.35rem;
}

.page-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}

.page-content table th,
.page-content table td {
    border: 1px solid #e1e4eb;
    padding: 0.65rem 0.75rem;
    vertical-align: top;
}

.page-content table th {
    background: #f1f5ff;
    font-weight: 600;
}

.responsibilities-grid,
.skills-grid,
.grid-2,
.grid-3,
.values-grid,
.metrics-grid,
.method-grid,
.events-list,
.developers-skills,
.challenges {
    display: grid;
    gap: 1rem;
}

.grid-2 {
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
}

.grid-3 {
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
}

.values-grid {
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
}

.metrics-grid,
.method-grid,
.events-list,
.responsibilities-grid,
.skills-grid,
.developers-skills,
.challenges {
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
}

.responsibility,
.skill,
.skill-card,
.team-type,
.po-variant,
.event-item,
.method-card,
.metric-card,
.challenge,
.value-card,
.practice-card,
.xp-card,
.phase,
.quick-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
}

.value-card {
    text-align: center;
}

.value-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.practice-section {
    padding: 1.25rem 1.5rem;
    border: 1px dashed #cbd5f5;
    border-radius: 12px;
    background: #f8fbff;
}

.practice-section > h3 {
    margin-top: 0;
    color: #0b5ed7;
}

.benefit {
    background: #ecfdf5;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    padding: 0.75rem;
    font-weight: 600;
    text-align: center;
}

.definition-stack div,
.story-template,
.moscow-example,
.team-example,
.dod-example,
.burndown-example,
.dsdm-diamond,
.legend {
    background: #f8f9ff;
    border: 1px dashed #cbd5f5;
    border-radius: 10px;
    padding: 0.9rem 1.1rem;
    margin-bottom: 0.9rem;
}

.kanban-board {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}

.kanban-column {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 1rem;
    min-height: 150px;
}

.warning-text {
    color: #dc3545;
    font-weight: 600;
}

.success-text {
    color: #198754;
    font-weight: 600;
}

.phases {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 0.75rem;
}

.crystal-table th,
.crystal-table td {
    text-align: center;
}

.xp-checklist,
.highlight-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.xp-checklist li,
.highlight-list li {
    padding: 0.5rem 0;
    border-bottom: 1px dashed #e2e8f0;
}

.xp-checklist li:last-child,
.highlight-list li:last-child {
    border-bottom: none;
}

.navigation-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 2rem;
}

.navigation-buttons .btn {
    min-width: 200px;
}

.navigation-buttons .btn-primary {
    background: #0d6efd;
    border-color: #0d6efd;
    box-shadow: 0 12px 24px rgba(13, 110, 253, 0.25);
}

.navigation-buttons .btn-secondary {
    background: #f1f5f9;
    color: #1e293b;
    border: 1px solid #d1d5db;
}

.sidebar-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 1.25rem 1.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.1);
    margin-bottom: 1.5rem;
}

.sidebar-card h4 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.quick-facts {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.quick-facts li {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.quick-facts li i {
    color: #0d6efd;
    margin-top: 0.2rem;
}

.resource-links a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-decoration: none;
    color: #0b5ed7;
    padding: 0.45rem 0;
    border-bottom: 1px dashed #e2e8f0;
}

.resource-links a:last-child {
    border-bottom: none;
}

.resource-links small {
    color: #94a3b8;
}

@media (max-width: 992px) {
    .navigation-buttons .btn {
        min-width: unset;
        flex: 1 1 45%;
    }
}
</style>
<?php } ?>

