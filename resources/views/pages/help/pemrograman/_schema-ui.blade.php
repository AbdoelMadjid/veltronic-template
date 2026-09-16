<style>
    :root,
    [data-bs-theme="light"] {
        --schema-ink: #10243f;
        --schema-muted: #5b6b7f;
        --schema-surface: #ffffff;
        --schema-line: #d7e3f2;
        --schema-accent: #0f766e;
        --schema-accent-soft: #e6f7f4;
        --schema-warn: #b45309;
        --schema-warn-soft: #fff5e6;
        --schema-warn-line: #b45309;
        --schema-warn-ink: #7a3e0b;
        --schema-info-soft: #e9f2ff;
        --schema-info-line: #1d4ed8;
        --schema-info-ink: #1e3a5f;
        --schema-code-ink: #183a61;
        --schema-code-bg: linear-gradient(125deg, #f4f8ff, #edf7f4);
        --schema-code-border: #c9dcef;
        --schema-code-inline-bg: #f1f5f9;
        --schema-code-inline-ink: #0b4e85;
        --schema-code-inline-border: #dbeafe;
        --schema-step-bg: #f8fbff;
        --schema-step-border: #b9cde8;
        --schema-step-ink: #173459;
        --schema-step-code-ink: #0b4e85;
        --schema-shell-border: #d7e3f2;
        --schema-shell-bg: radial-gradient(1100px 420px at 0% 0%, #e6f7f4 0%, transparent 60%),
                           radial-gradient(900px 380px at 100% 0%, #eef4ff 0%, transparent 55%),
                           #ffffff;
        --schema-hero-bg: linear-gradient(120deg, #0f766e, #0b4e85);
        --schema-hero-shadow: 0 20px 45px rgba(8, 36, 69, .18);
        --schema-chip-bg: #e6f7f4;
        --schema-chip-ink: #0f766e;
        --schema-chip-line: #bdebe4;
        --schema-card-shadow: 0 4px 14px rgba(15, 23, 42, .04);
    }

    [data-bs-theme="dark"],
    [data-theme="dark"],
    .dark-mode {
        --schema-ink: #e2e8f0;
        --schema-muted: #94a3b8;
        --schema-surface: #1e1e2d;
        --schema-line: #2b2b40;
        --schema-accent: #2dd4bf;
        --schema-accent-soft: rgba(45, 212, 191, 0.12);
        --schema-warn: #fbbf24;
        --schema-warn-soft: rgba(251, 191, 36, 0.12);
        --schema-warn-line: #f59e0b;
        --schema-warn-ink: #fde68a;
        --schema-info-soft: rgba(59, 130, 246, 0.12);
        --schema-info-line: #3b82f6;
        --schema-info-ink: #93c5fd;
        --schema-code-ink: #7dd3fc;
        --schema-code-bg: #151521;
        --schema-code-border: #2c3248;
        --schema-code-inline-bg: rgba(56, 189, 248, 0.12);
        --schema-code-inline-ink: #38bdf8;
        --schema-code-inline-border: rgba(56, 189, 248, 0.22);
        --schema-step-bg: #181926;
        --schema-step-border: #323b54;
        --schema-step-ink: #cbd5e1;
        --schema-step-code-ink: #38bdf8;
        --schema-shell-border: #2b2b40;
        --schema-shell-bg: radial-gradient(1100px 420px at 0% 0%, rgba(15, 118, 110, 0.15) 0%, transparent 60%),
                           radial-gradient(900px 380px at 100% 0%, rgba(14, 116, 144, 0.12) 0%, transparent 55%),
                           #151521;
        --schema-hero-bg: linear-gradient(120deg, #0d5f59, #133a63);
        --schema-hero-shadow: 0 16px 36px rgba(0, 0, 0, .45);
        --schema-chip-bg: rgba(45, 212, 191, 0.12);
        --schema-chip-ink: #2dd4bf;
        --schema-chip-line: rgba(45, 212, 191, 0.25);
        --schema-card-shadow: 0 4px 16px rgba(0, 0, 0, .3);
    }

    .schema-shell {
        font-family: "Poppins", "Nunito Sans", "Inter", sans-serif;
        background: var(--schema-shell-bg);
        border: 1px solid var(--schema-shell-border);
        border-radius: 1rem;
        padding: 1.5rem;
        transition: background .2s ease, border-color .2s ease;
    }

    .schema-hero {
        background: var(--schema-hero-bg);
        color: #fff;
        border-radius: 1rem;
        padding: 1.25rem 1.25rem 1rem;
        box-shadow: var(--schema-hero-shadow);
        margin-bottom: 1rem;
        animation: schemaFadeUp .35s ease-out both;
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .schema-hero h2 {
        margin: .2rem 0 .35rem;
        color: #fff;
    }

    .schema-pill {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        border-radius: 999px;
        padding: .3rem .7rem;
        font-size: .72rem;
        letter-spacing: .02em;
        text-transform: uppercase;
        font-weight: 700;
        background: rgba(255, 255, 255, .18);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .2);
    }

    .schema-lead {
        color: rgba(255, 255, 255, .92);
        margin: 0;
    }

    .schema-lead code {
        background: rgba(255, 255, 255, .2) !important;
        color: #fff !important;
        border: 1px solid rgba(255, 255, 255, .3) !important;
        padding: .15rem .45rem;
        border-radius: .35rem;
    }

    .schema-grid {
        display: grid;
        grid-template-columns: repeat(12, minmax(0, 1fr));
        gap: 1rem;
    }

    .schema-col-4 {
        grid-column: span 4 / span 4;
    }

    .schema-col-6 {
        grid-column: span 6 / span 6;
    }

    .schema-col-12 {
        grid-column: span 12 / span 12;
    }

    .schema-card {
        background: var(--schema-surface);
        border: 1px solid var(--schema-line);
        border-radius: .9rem;
        padding: 1.15rem;
        box-shadow: var(--schema-card-shadow);
        animation: schemaFadeUp .45s ease-out both;
        transition: background .2s ease, border-color .2s ease, box-shadow .2s ease;
    }

    .schema-card h4 {
        color: var(--schema-ink);
        margin-bottom: .6rem;
        font-weight: 700;
    }

    .schema-card h5,
    .schema-card h6 {
        color: var(--schema-ink);
    }

    .schema-card code:not(.schema-code code) {
        background: var(--schema-code-inline-bg);
        color: var(--schema-code-inline-ink);
        border: 1px solid var(--schema-code-inline-border);
        padding: .15rem .4rem;
        border-radius: .35rem;
        font-size: .85em;
        font-family: "JetBrains Mono", "Fira Code", Consolas, "Courier New", monospace;
    }

    .schema-note {
        background: var(--schema-info-soft);
        border-left: 4px solid var(--schema-info-line);
        border-radius: .7rem;
        padding: .75rem .85rem;
        color: var(--schema-info-ink);
        font-size: .9rem;
    }

    .schema-note code {
        background: rgba(29, 78, 216, .14) !important;
        color: var(--schema-info-ink) !important;
        border: 1px solid rgba(29, 78, 216, .22) !important;
    }

    [data-bs-theme="dark"] .schema-note code,
    [data-theme="dark"] .schema-note code,
    .dark-mode .schema-note code {
        background: rgba(59, 130, 246, .2) !important;
        color: #bfdbfe !important;
        border: 1px solid rgba(59, 130, 246, .3) !important;
    }

    .schema-warn {
        background: var(--schema-warn-soft);
        border-left: 4px solid var(--schema-warn-line);
        border-radius: .7rem;
        padding: .75rem .85rem;
        color: var(--schema-warn-ink);
        font-size: .9rem;
    }

    .schema-warn code {
        background: rgba(180, 83, 9, .14) !important;
        color: var(--schema-warn-ink) !important;
        border: 1px solid rgba(180, 83, 9, .22) !important;
    }

    [data-bs-theme="dark"] .schema-warn code,
    [data-theme="dark"] .schema-warn code,
    .dark-mode .schema-warn code {
        background: rgba(245, 158, 11, .2) !important;
        color: #fef08a !important;
        border: 1px solid rgba(245, 158, 11, .3) !important;
    }

    .schema-list {
        margin: 0;
        padding-left: 1.1rem;
        color: var(--schema-muted);
    }

    .schema-list li {
        margin-bottom: .45rem;
    }

    .schema-list code {
        background: var(--schema-code-inline-bg);
        color: var(--schema-code-inline-ink);
        border: 1px solid var(--schema-code-inline-border);
        padding: .12rem .35rem;
        border-radius: .35rem;
        font-size: .85em;
    }

    .schema-flow {
        display: grid;
        gap: .65rem;
    }

    .schema-step {
        border: 1px dashed var(--schema-step-border);
        background: var(--schema-step-bg);
        border-radius: .75rem;
        padding: .65rem .75rem;
        color: var(--schema-step-ink);
        font-size: .92rem;
        position: relative;
        transition: background .2s ease, border-color .2s ease;
    }

    .schema-step code {
        color: var(--schema-step-code-ink);
    }

    .schema-code {
        margin: 0;
        border-radius: .8rem;
        padding: .9rem;
        background: var(--schema-code-bg);
        color: var(--schema-code-ink);
        font-size: .84rem;
        border: 1px solid var(--schema-code-border);
        box-shadow: 0 8px 18px rgba(0, 0, 0, .06), inset 0 1px 0 rgba(255, 255, 255, .05);
        overflow: auto;
        transition: background .2s ease, border-color .2s ease;
    }

    .schema-code code {
        color: var(--schema-code-ink) !important;
        font-family: "JetBrains Mono", "Fira Code", Consolas, "Courier New", monospace;
        line-height: 1.6;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
    }

    .schema-chip {
        display: inline-block;
        margin: 0 .3rem .35rem 0;
        background: var(--schema-chip-bg);
        color: var(--schema-chip-ink);
        border: 1px solid var(--schema-chip-line);
        border-radius: .6rem;
        padding: .25rem .55rem;
        font-size: .78rem;
        font-weight: 600;
        transition: background .2s ease, border-color .2s ease;
    }

    .schema-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .4rem;
        margin-top: .5rem;
    }

    @keyframes schemaFadeUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991.98px) {
        .schema-col-4,
        .schema-col-6 {
            grid-column: span 12 / span 12;
        }
    }
</style>