/**
 * SQL-Trainer: Datensatz und Levels.
 *
 * Jedes Level wird geprüft, indem die Abfrage des Spielers und die Musterlösung auf einer frischen
 * Kopie der Datenbank laufen und die Ergebnisse verglichen werden (Spaltenanzahl + Zeilen;
 * Reihenfolge nur bei ordered: true). Spaltennamen/Aliase sind egal.
 *
 * traps: typische Fehler. Liefert die Abfrage des Spielers dasselbe Ergebnis wie eine Falle,
 * wird deren Hinweis angezeigt.
 */
window.SQL_TRAINER_DATA = {
    dataset: `
CREATE TABLE abteilung (
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL,
  standort TEXT NOT NULL
);
CREATE TABLE mitarbeiter (
  id INTEGER PRIMARY KEY,
  name TEXT NOT NULL,
  abteilung_id INTEGER REFERENCES abteilung(id),
  gehalt INTEGER NOT NULL,
  eintritt TEXT NOT NULL
);
CREATE TABLE ticket (
  id INTEGER PRIMARY KEY,
  titel TEXT NOT NULL,
  prioritaet TEXT NOT NULL,
  status TEXT NOT NULL,
  mitarbeiter_id INTEGER REFERENCES mitarbeiter(id),
  erstellt_am TEXT NOT NULL
);
INSERT INTO abteilung VALUES
  (1, 'IT-Support', 'Köln'), (2, 'Entwicklung', 'Köln'), (3, 'Vertrieb', 'Bonn'), (4, 'Buchhaltung', 'Bonn');
INSERT INTO mitarbeiter VALUES
  (1, 'Lena Wolf', 1, 3400, '2021-04-01'),
  (2, 'Tom Berger', 1, 3100, '2023-09-01'),
  (3, 'Aylin Demir', 2, 4200, '2019-02-15'),
  (4, 'Max Krüger', 2, 3900, '2022-06-01'),
  (5, 'Sofia Rossi', 3, 3600, '2020-11-01'),
  (6, 'Jonas Weber', NULL, 2800, '2024-08-01');
INSERT INTO ticket VALUES
  (101, 'Drucker im 2. OG druckt nicht', 'niedrig', 'offen', 2, '2026-03-02'),
  (102, 'VPN-Verbindung bricht ab', 'hoch', 'in Arbeit', 1, '2026-03-03'),
  (103, 'Passwort zurücksetzen', 'mittel', 'erledigt', 2, '2026-03-03'),
  (104, 'Neuer Laptop für den Vertrieb', 'mittel', 'offen', NULL, '2026-03-04'),
  (105, 'Datenbank-Backup fehlgeschlagen', 'hoch', 'offen', 3, '2026-03-05'),
  (106, 'Monitor flackert', 'niedrig', 'erledigt', 1, '2026-03-05'),
  (107, 'Zugriff auf CRM gesperrt', 'hoch', 'offen', 1, '2026-03-06'),
  (108, 'Outlook startet nicht', 'mittel', 'in Arbeit', 2, '2026-03-06');
`,

    levels: [
        {
            id: 1, title: 'Erster Arbeitstag', topic: 'SELECT *',
            story: 'Willkommen im IT-Support der ByteBurg GmbH! Deine Teamleiterin Lena Wolf möchte, dass du dir zuerst einen Überblick über das Team verschaffst.',
            task: 'Zeige alle Spalten und alle Datensätze der Tabelle mitarbeiter an.',
            hint: 'Mit * wählst du alle Spalten aus: SELECT * FROM tabellenname;',
            solution: 'SELECT * FROM mitarbeiter;'
        },
        {
            id: 2, title: 'Nur das Nötige', topic: 'Spalten auswählen',
            story: 'Die Personalabteilung braucht für eine Auswertung nur zwei Angaben – alles andere wäre zu viel des Guten (Datensparsamkeit!).',
            task: 'Gib nur die Spalten name und gehalt aller Mitarbeiter aus.',
            hint: 'Statt * schreibst du die gewünschten Spalten, getrennt durch Komma: SELECT spalte1, spalte2 FROM …',
            solution: 'SELECT name, gehalt FROM mitarbeiter;'
        },
        {
            id: 3, title: 'Was brennt?', topic: 'WHERE',
            story: 'Montagmorgen, 8:05 Uhr. Das Ticketsystem quillt über. Zuerst kümmerst du dich um das Dringendste.',
            task: "Zeige alle Tickets mit der Priorität 'hoch' (alle Spalten).",
            hint: "Zeilen filterst du mit WHERE spalte = 'wert'. Texte stehen in einfachen Anführungszeichen.",
            solution: "SELECT * FROM ticket WHERE prioritaet = 'hoch';"
        },
        {
            id: 4, title: 'Offen und dringend', topic: 'AND',
            story: 'Manche der dringenden Tickets sind schon in Bearbeitung. Lena will nur die sehen, um die sich noch niemand kümmert.',
            task: 'Gib nur den titel aller Tickets aus, die den Status offen UND die Priorität hoch haben.',
            hint: 'Zwei Bedingungen verknüpfst du mit AND: WHERE status = … AND prioritaet = …',
            solution: "SELECT titel FROM ticket WHERE status = 'offen' AND prioritaet = 'hoch';"
        },
        {
            id: 5, title: 'Gehaltsranking', topic: 'ORDER BY',
            story: 'Für die Budgetplanung braucht die Geschäftsführung eine sortierte Liste.',
            task: 'Gib name und gehalt aller Mitarbeiter aus – das höchste Gehalt zuerst.',
            hint: 'ORDER BY spalte DESC sortiert absteigend (ohne DESC wird aufsteigend sortiert).',
            solution: 'SELECT name, gehalt FROM mitarbeiter ORDER BY gehalt DESC;',
            ordered: true,
            traps: [
                { sql: 'SELECT name, gehalt FROM mitarbeiter ORDER BY gehalt;', message: 'Richtig sortiert – nur andersherum. Ohne DESC sortiert ORDER BY aufsteigend.' }
            ]
        },
        {
            id: 6, title: 'Namenssuche', topic: 'LIKE',
            story: "Ein Anrufer erinnert sich nur noch daran, dass der Nachname seines Ansprechpartners auf „er“ endete.",
            task: "Finde alle Mitarbeiter, deren Name auf 'er' endet. Gib nur die Spalte name aus.",
            hint: "LIKE vergleicht mit einem Muster: % steht für beliebig viele Zeichen. Wo muss das % stehen, wenn der Name auf 'er' ENDET?",
            solution: "SELECT name FROM mitarbeiter WHERE name LIKE '%er';",
            traps: [
                { sql: "SELECT name FROM mitarbeiter WHERE name LIKE 'er%';", message: "'er%' findet Namen, die mit „er“ BEGINNEN. Das % gehört hier nach vorne." },
                { sql: "SELECT name FROM mitarbeiter WHERE name LIKE '%er%';", message: "'%er%' findet „er“ irgendwo im Namen. Gesucht sind Namen, die auf „er“ ENDEN." }
            ]
        },
        {
            id: 7, title: 'Der Neue ohne Team', topic: 'IS NULL',
            story: 'Ein neuer Azubi steht schon im System, wurde aber noch keiner Abteilung zugeordnet. Das musst du der Personalabteilung melden.',
            task: 'Finde alle Mitarbeiter, die keiner Abteilung zugeordnet sind. Gib nur die Spalte name aus.',
            hint: 'Fehlende Werte sind NULL. Vergleiche mit IS NULL – nicht mit = NULL!',
            solution: 'SELECT name FROM mitarbeiter WHERE abteilung_id IS NULL;',
            traps: [
                { sql: 'SELECT name FROM mitarbeiter WHERE abteilung_id = NULL;', message: 'Mit = NULL findest du nie etwas: Ein Vergleich mit NULL ergibt „unbekannt“, nie „wahr“. Nutze IS NULL.' }
            ]
        },
        {
            id: 8, title: 'Liegengeblieben', topic: 'AND + IS NULL',
            story: 'Ein offenes Ticket hat noch keinen Bearbeiter. Bevor sich der Vertrieb beschwert, solltest du es finden.',
            task: 'Gib id und titel aller offenen Tickets aus, denen noch kein Mitarbeiter zugewiesen ist.',
            hint: "Zwei Bedingungen: status = 'offen' und mitarbeiter_id IS NULL – verbunden mit AND.",
            solution: "SELECT id, titel FROM ticket WHERE status = 'offen' AND mitarbeiter_id IS NULL;"
        },
        {
            id: 9, title: 'Lagebericht', topic: 'GROUP BY + COUNT',
            story: 'Im Daily-Stand-up um 9 Uhr willst du kurz berichten, wie es um die Tickets steht.',
            task: 'Wie viele Tickets gibt es je Status? Gib den status und die Anzahl aus.',
            hint: 'COUNT(*) zählt Zeilen. GROUP BY status bildet für jeden Status eine eigene Gruppe.',
            solution: 'SELECT status, COUNT(*) AS anzahl FROM ticket GROUP BY status;'
        },
        {
            id: 10, title: 'Wer arbeitet woran?', topic: 'INNER JOIN',
            story: 'In der Tabelle ticket steht nur die mitarbeiter_id. Lena möchte aber Namen sehen.',
            task: 'Gib zu jedem zugewiesenen Ticket den titel und den name des zuständigen Mitarbeiters aus.',
            hint: 'Verbinde die Tabellen: FROM ticket t JOIN mitarbeiter m ON m.id = t.mitarbeiter_id',
            solution: 'SELECT t.titel, m.name FROM ticket t INNER JOIN mitarbeiter m ON m.id = t.mitarbeiter_id;',
            traps: [
                { sql: 'SELECT t.titel, m.name FROM ticket t, mitarbeiter m;', message: 'Das ist das kartesische Produkt: Ohne Verknüpfungsbedingung wird jedes Ticket mit jedem Mitarbeiter kombiniert. Ergänze ON m.id = t.mitarbeiter_id.' }
            ]
        },
        {
            id: 11, title: 'Auslastung', topic: 'LEFT JOIN + COUNT',
            story: 'Sind die Tickets fair verteilt? Für die Übersicht sollen auch Kolleginnen und Kollegen ohne Ticket erscheinen.',
            task: 'Gib für ALLE Mitarbeiter den name und die Anzahl ihrer Tickets aus – Mitarbeiter ohne Ticket mit 0.',
            hint: 'Damit auch Mitarbeiter ohne Ticket erscheinen, brauchst du einen LEFT JOIN von mitarbeiter auf ticket. Zähle mit COUNT(t.id) – nicht mit COUNT(*).',
            solution: 'SELECT m.name, COUNT(t.id) AS anzahl FROM mitarbeiter m LEFT JOIN ticket t ON t.mitarbeiter_id = m.id GROUP BY m.id, m.name;',
            traps: [
                { sql: 'SELECT m.name, COUNT(*) FROM mitarbeiter m LEFT JOIN ticket t ON t.mitarbeiter_id = m.id GROUP BY m.id, m.name;', message: 'Fast! COUNT(*) zählt bei Mitarbeitern ohne Ticket die Zeile mit den NULL-Werten mit (ergibt 1 statt 0). Zähle mit COUNT(t.id).' },
                { sql: 'SELECT m.name, COUNT(t.id) FROM mitarbeiter m JOIN ticket t ON t.mitarbeiter_id = m.id GROUP BY m.id, m.name;', message: 'Mitarbeiter ohne Ticket fehlen: Beim INNER JOIN fallen sie heraus. Verwende LEFT JOIN.' }
            ]
        },
        {
            id: 12, title: 'Teamgröße', topic: 'HAVING',
            story: 'Für die Urlaubsplanung soll jede Abteilung mit mindestens zwei Personen eine Vertretungsregel bekommen.',
            task: 'Welche Abteilungen haben mehr als einen Mitarbeiter? Gib den Abteilungsnamen und die Anzahl aus.',
            hint: 'Verbinde abteilung und mitarbeiter, gruppiere nach der Abteilung und filtere die Gruppen mit HAVING COUNT(*) > 1. In WHERE sind Aggregatfunktionen nicht erlaubt.',
            solution: 'SELECT a.name, COUNT(*) AS anzahl FROM abteilung a JOIN mitarbeiter m ON m.abteilung_id = a.id GROUP BY a.id, a.name HAVING COUNT(*) > 1;'
        },
        {
            id: 13, title: 'Gehaltscheck', topic: 'Unterabfrage',
            story: 'Die Geschäftsführung fragt, wer überdurchschnittlich verdient.',
            task: 'Welche Mitarbeiter verdienen mehr als der Durchschnitt aller Mitarbeiter? Gib name und gehalt aus.',
            hint: 'Den Durchschnitt liefert eine Unterabfrage: WHERE gehalt > (SELECT AVG(gehalt) FROM mitarbeiter)',
            solution: 'SELECT name, gehalt FROM mitarbeiter WHERE gehalt > (SELECT AVG(gehalt) FROM mitarbeiter);'
        },
        {
            id: 14, title: 'Standortvergleich', topic: 'JOIN + AVG + GROUP BY + ORDER BY',
            story: 'Abschlussaufgabe: Die ByteBurg GmbH überlegt, einen Standort zu vergrößern, und braucht Zahlen.',
            task: 'Ermittle das Durchschnittsgehalt je Standort (standort und Durchschnitt), höchster Durchschnitt zuerst. Mitarbeiter ohne Abteilung zählen nicht mit.',
            hint: 'Der Standort steht in abteilung – du brauchst einen JOIN. Dann AVG(m.gehalt) mit GROUP BY a.standort und ORDER BY … DESC.',
            solution: 'SELECT a.standort, AVG(m.gehalt) AS durchschnitt FROM mitarbeiter m JOIN abteilung a ON a.id = m.abteilung_id GROUP BY a.standort ORDER BY durchschnitt DESC;',
            ordered: true
        }
    ]
};
